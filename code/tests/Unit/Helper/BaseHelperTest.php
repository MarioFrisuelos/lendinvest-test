<?php

declare(strict_types=1);

namespace AppTest\Unit\Helper;

use PHPUnit\Framework\TestCase;

use App\Entity\Fund;
use App\Repository\FundRepository;

use App\Entity\Tranche;
use App\Repository\TrancheRepository;

use App\Entity\Loan;
use App\Repository\LoanRepository;

use App\Entity\Wallet;
use App\Repository\WalletRepository;

use App\Entity\Investor;
use App\Repository\InvestorRepository;

use App\Entity\Investment;
use App\Repository\InvestmentRepository;

use App\Request\InvestmentRequest;
use App\Helper\Investment\MakeInvestment;

use App\Request\CalculateInterestRequest;
use App\Helper\Interest\CalculateInterest;

abstract class BaseHelperTest extends TestCase
{
	/** @var Loan */
	protected $fakeLoan;

	/** @var array */
	protected $fakeInvestor;

	public function setUp(): void
    {
        parent::setUp();
        # Create fake data
        $this->fakeLoan = $this->createFakeLoan();
        $this->fakeInvestor['investor1'] = $this->createFakeInvestor(1, 1000, 'GBP');
        $this->fakeInvestor['investor2'] = $this->createFakeInvestor(2, 1000, 'GBP');
        $this->fakeInvestor['investor3'] = $this->createFakeInvestor(3, 1000, 'GBP');
        $this->fakeInvestor['investor4'] = $this->createFakeInvestor(4, 1000, 'GBP');
    }

    public function createFakeInvestor($investorNumber, $liquidity, $currency)
    {
		# Create the wallet  
		$fakeWallet = $this->createFakeWallet($liquidity, $currency);
		# Create the investor
		$investorRepository = new InvestorRepository((new Investor()));

		return $investorRepository->create([
			'name' => 'Investor'.$investorNumber,
			'wallet' => $fakeWallet
		]);
    }

    private function createFakeWallet($liquidity, $currency)
    {
		# Create the fund
		$fakeFund = $this->createFakeFund($liquidity, $currency);
		# Create the wallet
		$walletRepository = new WalletRepository((new Wallet()));
		
		return $walletRepository->create([
			'fund' => $fakeFund
		]);
    }

    private function createFakeLoan()
    {
    	# Create the tranches
    	$fakeTrancheA = $this->createFakeTranche(3, 'A', 1000, 'GBP');
    	$fakeTrancheB = $this->createFakeTranche(6, 'B', 1000, 'GBP');
    	# Create the loan
    	$loanRepository = new LoanRepository((new Loan()));
    	$fakeLoan = $loanRepository->create([
			'startDate' => (new \DateTime())->setDate(2020, 10, 1),
			'endDate' => (new \DateTime())->setDate(2021, 11, 15),
			'tranche' => $fakeTrancheA
		]);
		$fakeLoan->addTranche($fakeTrancheB);

		return $fakeLoan;
    }

    private function createFakeTranche(
    	$interestRate, 
    	$name, 
    	$liquidity, 
    	$currency
    ) {
		# Create the fund
		$fakeFund = $this->createFakeFund($liquidity, $currency);
		# Create the tranche
		$trancheRepository = new TrancheRepository((new Tranche()));
    	
    	return $trancheRepository->create([
			'interestRate' => $interestRate,
			'name' => $name,
			'fund' => $fakeFund,
		]);
    }

    private function createFakeFund($liquidity, $currency)
    {
    	$fundRepository = new FundRepository((new Fund()));
    	
    	return $fundRepository->create([
			'liquidity' => $liquidity,
			'currency' => $currency
		]);
    }

    protected function getMakeInvestmentInstance()
    {
        return new MakeInvestment(
            new FundRepository((new Fund())),
            new InvestmentRepository((new Investment()))
        );
    }

    protected function getInvestmentRequestInstance(
        $amountToInvest,
        $created,
        $investor,
        $tranche
    ) {
        return new InvestmentRequest(
            $amountToInvest,
            $created,
            $investor,
            $tranche
        );
    }

    protected function getCalculateInterestInstance()
    {
        return new CalculateInterest();
    }

    protected function getCalculateInterestRequestInstance(
        $startDate, 
        $endDate, 
        $investments
    ) {
        return new CalculateInterestRequest(
            $startDate, 
            $endDate,
            $investments
        );
    }
}