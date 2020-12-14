<?php

declare(strict_types=1);

namespace AppTest\Unit\Repository;

use PHPUnit\Framework\TestCase;
use App\Entity\Tranche;
use App\Repository\TrancheRepository;
use App\Entity\Fund;
use App\Entity\Loan;

class TrancheRepositoryTest extends TestCase
{
	/** @var Tranche */
	private $trancheTestResult;

	/**var array */
	private $testDataArray;

    public function setUp(): void
    {
        parent::setUp();
        $this->testDataArray = [
        	'id' => 'Test',
        	'created' => (new \DateTime())->setDate(2020, 12, 31),
        	'interestRate' => 2.3,
            'name' => "Tranche test",
        	'fund' => new Fund(),
            'loan' => new Loan()
		];
		$trancheRepositoryInstance = new TrancheRepository((new Tranche()));
        $this->trancheTestResult = $trancheRepositoryInstance->create($this->testDataArray);
    }

   	public function testAbstractParentClassValueProperty()
    {
    	$this->assertEquals($this->testDataArray['id'], $this->trancheTestResult->getId());
    	$this->assertEquals($this->testDataArray['created'], $this->trancheTestResult->getCreated());
    }

    public function testInterestRateValueProperty()
    {
        $this->assertEquals($this->testDataArray['interestRate'], $this->trancheTestResult->getInterestRate());
        $this->assertIsFloat($this->trancheTestResult->getInterestRate());
    }

    public function testNameValueProperty()
    {
        $this->assertEquals($this->testDataArray['name'], $this->trancheTestResult->getName());
        $this->assertIsString($this->trancheTestResult->getName());
    }

    public function testEntityRelationshipValueProperty()
    {
        $this->assertInstanceOf(Fund::class, $this->trancheTestResult->getFund());
    	$this->assertInstanceOf(Loan::class, $this->trancheTestResult->getLoan());
    }
}