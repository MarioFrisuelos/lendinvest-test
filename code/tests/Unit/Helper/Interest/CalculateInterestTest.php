<?php

declare(strict_types=1);

namespace AppTest\Unit\Helper\Interest;

use AppTest\Unit\Helper\BaseHelperTest;

class CalculateInterestTest extends BaseHelperTest
{
	/** @var array */
	private $fakeInvestment;

	public function setUp(): void
    {
        parent::setUp();
        # Create fake investment data
        $this->fakeInvestment[] = $this->createFakeInvestment(
        	1000,
        	(new \DateTime())->setDate(2021, 10, 3),
        	$this->fakeInvestor['investor1'],
			$this->fakeLoan->getTranche()[0]// Tranche A
        );
        $this->fakeInvestment[] = $this->createFakeInvestment(
        	500,
			(new \DateTime())->setDate(2021, 10, 10),
			$this->fakeInvestor['investor3'],
			$this->fakeLoan->getTranche()[1]// Tranche B
        );
    }

    private function createFakeInvestment(        
    	$amountToInvest,
        $created,
        $investor,
        $tranche
    ) {
		# Create the investment request
		$investRequest = $this->getInvestmentRequestInstance(
			$amountToInvest,
	        $created,
	        $investor,
	        $tranche	
		);
		# Create the new investment
		$makeInvestmentInstance = $this->getMakeInvestmentInstance();
		
		return $makeInvestmentInstance->handle($investRequest);
    }

    public function testCalculateInterest()
    {
    	# Create the calculate interest request
    	$calculateInterestRequest = $this->getCalculateInterestRequestInstance(
    		(new \DateTime())->setDate(2021, 10, 1),
    		(new \DateTime())->setDate(2021, 10, 31),
    		$this->fakeInvestment
    	);
    	# Calculate interest
    	$calculateInterestInstance = $this->getCalculateInterestInstance();
    	$resultCalculateInterest = $calculateInterestInstance->handle($calculateInterestRequest); 

    	# Investor 1
    	$this->assertEquals($resultCalculateInterest[0]["nameInvestor"], 'Investor1');
    	$this->assertEquals($resultCalculateInterest[0]["earn"], 27.10);
    	# Investor 3
    	$this->assertEquals($resultCalculateInterest[1]["nameInvestor"], 'Investor3');
    	$this->assertEquals($resultCalculateInterest[1]["earn"], 20.32);
    }
}