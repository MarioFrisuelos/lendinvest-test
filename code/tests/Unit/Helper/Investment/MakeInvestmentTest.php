<?php

declare(strict_types=1);

namespace AppTest\Unit\Helper\Investment;

use AppTest\Unit\Helper\BaseHelperTest;
use App\Entity\Investment;

class MakeInvestmentTest extends BaseHelperTest
{
	public function testInvestor1MakeAnInvest()
	{
		$amountToInvest = 1000;
		# Create the investment request
		$investRequest = $this->getInvestmentRequestInstance(
			$amountToInvest,
			(new \DateTime())->setDate(2021, 10, 3),
			$this->fakeInvestor['investor1'],
			$this->fakeLoan->getTranche()[0]// Tranche A		
		);
		# Create the new investment
		$makeInvestmentInstance = $this->getMakeInvestmentInstance();
		$investorNewInvestment = $makeInvestmentInstance->handle($investRequest);

		$this->assertInstanceOf(Investment::class, $investorNewInvestment);
	}

	public function testInvestor2MakeAnInvest()
	{
		$this->fakeLoan->getTranche()[0]->getFund()->setLiquidity(0);
		$amountToInvest = 1;
		# Create the investment request
		$investRequest = $this->getInvestmentRequestInstance(
			$amountToInvest,
			(new \DateTime())->setDate(2021, 4, 10),
			$this->fakeInvestor['investor2'],
			$this->fakeLoan->getTranche()[0]// Tranche A		
		);
		# Create the new investment
		$makeInvestmentInstance = $this->getMakeInvestmentInstance();
		try {
			$investorNewInvestment = $makeInvestmentInstance->handle($investRequest);
		} catch (\Exception $e) {
		    $this->assertEquals($e->getMessage(), 'The tranche has reached the maximum amount available to invest.');
		}
	}

	public function testInvestor3MakeAnInvest()
	{
		$amountToInvest = 500;
		# Create the investment request
		$investRequest = $this->getInvestmentRequestInstance(
			$amountToInvest,
			(new \DateTime())->setDate(2021, 10, 10),
			$this->fakeInvestor['investor3'],
			$this->fakeLoan->getTranche()[1]// Tranche B		
		);
		# Create the new investment
		$makeInvestmentInstance = $this->getMakeInvestmentInstance();
		$investor1NewInvestment = $makeInvestmentInstance->handle($investRequest);

		$this->assertInstanceOf(Investment::class, $investor1NewInvestment);
	}

	public function testInvestor4MakeAnInvest()
	{
		$this->fakeLoan->getTranche()[1]->getFund()->setLiquidity(500);
		$amountToInvest = 1100;
		# Create the investment request
		$investRequest = $this->getInvestmentRequestInstance(
			$amountToInvest,
			(new \DateTime())->setDate(2021, 10, 25),
			$this->fakeInvestor['investor3'],
			$this->fakeLoan->getTranche()[1]// Tranche B		
		);
		# Create the new investment
		$makeInvestmentInstance = $this->getMakeInvestmentInstance();
		try {
			$investorNewInvestment = $makeInvestmentInstance->handle($investRequest);
		} catch (\Exception $e) {
		    $this->assertEquals($e->getMessage(), 'The investor wallet has not enough liquidity.');
		}catch (\Exception $e) {
		    $this->assertEquals($e->getMessage(), 'The tranche has reached the maximum amount available to invest.');
		}
	}
}