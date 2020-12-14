<?php

declare(strict_types=1);

namespace App\Helper\Investment;

use App\Repository\FundRepository;
use App\Repository\InvestmentRepository;
use App\Request\RequestInterface;
use App\Entity\BaseEntityInterface;

final class MakeInvestment implements InvestmentInterface
{
	/** @var FundRepository */
    private $fundRepository;

    /** @var InvestmentRepository */
    private $investmentRepository;

    /**
     * @param FundRepository $fundRepository
     * @param InvestmentRepository $investmentRepository
     */
	function __construct(
		FundRepository $fundRepository,
		InvestmentRepository $investmentRepository
	) {
		$this->fundRepository = $fundRepository;
		$this->investmentRepository = $investmentRepository;
	}

	/**
	 * @param RequestInterface $request
	 * 
	 * @return BaseEntityInterface
	 * @throws \Exception
	 */
	public function handle(RequestInterface $request): BaseEntityInterface
	{
		/** 
		 * 1st Check if the loan associated to the tranche is still available.
		 */
		if ($request->getCreated() > $request->getTranche()->getLoan()->getEndDate()) {
			throw new \Exception("The loan associated to this tranche has expired and is no longer available.");
		}
		/** 
		 * 2nd Check the maximum amount allowed for the tranche.
		 */
		if (!$request->getTranche()->getFund()->getLiquidity() 
			&& $request->getTranche()->getFund()->getLiquidity() <= $request->getAmountToInvest()
		) {
			throw new \Exception("The tranche has reached the maximum amount available to invest.");
		}
		/** 
		 * 3rd Check if the investor has enough liquidity to acquire a 
		 * participation of the tranche. 
		 * 
		 * Mario note: In an optimal solution we should know how much money 
		 * left has the user and the currency of it before to perform 
		 * this action. 
		 */
		if (!$this->checkInvestorFund(
			$request->getTranche(), 
			$request->getInvestor(), 
			$request->getAmountToInvest())
		) {
			throw new \Exception("The investor wallet has not enough liquidity.");
		}
		# 4th Create a new investment process.
		# 4.1 Create a fund record first. 
		$newFundEntry = [
			'liquidity' => $request->getAmountToInvest(),
			'currency' => $request->getTranche()->getFund()->getCurrency()
		];
		$newFundEntry = $this->fundRepository->create($newFundEntry);
		# 4.2 Create the new investment record.
		$newInvestment = [
			'created' => $request->getCreated(),
			'investor' => $request->getInvestor(),
			'tranche' => $request->getTranche(),
			'fund' => $newFundEntry
		];
		$newInvestment = $this->investmentRepository->create($newInvestment);

		return $newInvestment;
		/** 
		 * Mario note: After this point the system should perform the following 
		 * actions: 
		 * - Update the balance of the selected wallet.
		 * - Update the tranche balance.
		 */
	}

	/**
	 * @param object $tranche
	 * @param object $investor
	 * @param float $amountToInvest
	 *
	 * @return bool
	 */
	private function checkInvestorFund(
		$tranche, 
		$investor, 
		float $amountToInvest
	): bool
	{
		$trancheCurrency = $tranche->getFund()->getCurrency();
		foreach ($investor->getWallet() as $keyWallet => $valueWallet) {
			$walletCurrency = $valueWallet->getFund()->getCurrency();
			$walletLiquidity = $valueWallet->getFund()->getLiquidity();
			if ($trancheCurrency == $walletCurrency && 
				$walletLiquidity >= $amountToInvest
			) {
				return true;
			}			
		}

		return false;
	}
}
