<?php

declare(strict_types=1);

namespace AppTest\Unit\Repository;

use PHPUnit\Framework\TestCase;
use App\Entity\Investment;
use App\Repository\InvestmentRepository;
use App\Entity\Investor;
use App\Entity\Tranche;
use App\Entity\Fund;

class InvestmentRepositoryTest extends TestCase
{
	/** @var Investment */
	private $investmentTestResult;

	/**var array */
	private $testDataArray;

    public function setUp(): void
    {
        parent::setUp();
        $this->testDataArray = [
        	'id' => 'Test',
        	'created' => (new \DateTime())->setDate(2020, 12, 31),
			'investor' => new Investor(),
			'tranche' => new Tranche(),
			'fund' => new Fund(),

		];
		$investmentRepositoryInstance = new InvestmentRepository((new Investment()));
        $this->investmentTestResult = $investmentRepositoryInstance->create($this->testDataArray);
    }

   	public function testAbstractParentClassValueProperty()
    {
    	$this->assertEquals($this->testDataArray['id'], $this->investmentTestResult->getId());
    	$this->assertEquals($this->testDataArray['created'], $this->investmentTestResult->getCreated());
    }

    public function testEntityRelationshipValueProperty()
    {
    	$this->assertInstanceOf(Investor::class, $this->investmentTestResult->getInvestor());
    	$this->assertInstanceOf(Tranche::class, $this->investmentTestResult->getTranche());
    	$this->assertInstanceOf(Fund::class, $this->investmentTestResult->getFund());
    }
}