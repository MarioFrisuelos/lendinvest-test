<?php

declare(strict_types=1);

namespace App\Helper\Interest;

use App\Request\RequestInterface;

final class CalculateInterest implements InterestInterface
{
    const TOTAL_DAYS_MONTH = 31;

    /**
     * @param RequestInterface $request
     *
     * @return array 
     */
    public function handle(RequestInterface $request): array
    {
        # 1st Iterate between the investments provided in the step before.
        $resultInvestments = [];
        $investments = $request->getInvestments();
        foreach ($investments as $keyInvestment => $singleInvestment) {
            /** 
             * 2.1 Calculate the date range.
             * It takes in consideration if the investment was made
             * after the start date.
             */
            $dateRange = $singleInvestment->getCreated() > $request->getStartDate() ?
                $request->getEndDate()->diff($singleInvestment->getCreated())->format("%a") : 
                $request->getEndDate()->diff($request->getStartDate())->format("%a");
            # 2.2 Calculate 'daily interest'. 
            $dailyInterest = $singleInvestment->getTranche()->getInterestRate() / self::TOTAL_DAYS_MONTH;
            # 2.3 Calculate the 'Invested period interest rate'.
            $periodInterestRate = $dailyInterest * $dateRange;
            /**
             * 2.4 Calculate the 'Earned interest'.
             * Mario note: Due there is no specification in the requirements 
             * I assume this calculation will perform as usual (left to right).
             */
            $earn = $singleInvestment->getFund()->getLiquidity() / 100 * $periodInterestRate;
            /**
             * 2.5 Generate a response which will return: 
             * A specific investor with the tranche he invest 
             * during a period of time with an interest applied 
             * how much money will made. 
             */
            $resultInvestments[] = [
                'nameInvestor' => $singleInvestment->getInvestor()->getName(),
                'nameTranche' => $singleInvestment->getTranche()->getName(),
                'startDate' => $request->getStartDate(),
                'endDate' => $request->getEndDate(),
                'interestRate' => $singleInvestment->getTranche()->getInterestRate(),
                'earn' => round($earn, 2),
                'currency' => $singleInvestment->getFund()->getCurrency()
            ];
        }

        return $resultInvestments;
    }
}