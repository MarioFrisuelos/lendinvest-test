<?php

declare(strict_types=1);

namespace AppTest\Unit\Repository;

use PHPUnit\Framework\TestCase;
use App\Entity\Fund;
use App\Repository\FundRepository;
use App\Entity\Wallet;
use App\Entity\Investment;
use App\Entity\Tranche;

class FundRepositoryTest extends TestCase
{
	/** @var Fund */
	private $fundTestResult;

	/**var array */
	private $testDataArray;

    public function setUp(): void
    {
        parent::setUp();
        $this->testDataArray = [
        	'id' => 'TestFund',
        	'created' => (new \DateTime())->setDate(2020, 12, 31),
			'liquidity' => 123.4512,
			'currency' => "USD",
			'wallet' => new Wallet(),
			'investment' => new Investment(),
			'tranche' => new Tranche(),

		];
		$fundRepositoryInstance = new FundRepository((new Fund()));
        $this->fundTestResult = $fundRepositoryInstance->create($this->testDataArray);
    }

    public function testAbstractParentClassValueProperty()
    {
    	$this->assertEquals($this->testDataArray['id'], $this->fundTestResult->getId());
    	$this->assertEquals($this->testDataArray['created'], $this->fundTestResult->getCreated());
    }

    public function testLiquidityValueProperty()
    {
    	$this->assertEquals($this->testDataArray['liquidity'], $this->fundTestResult->getLiquidity());
    	$this->assertIsFloat($this->fundTestResult->getLiquidity());
    }

    public function testCurrencyValueProperty()
    {
    	$this->assertEquals($this->testDataArray['currency'], $this->fundTestResult->getCurrency());
    	$this->assertIsString($this->fundTestResult->getCurrency());
    }

    public function testEntityRelationshipValueProperty()
    {
    	$this->assertInstanceOf(Wallet::class, $this->fundTestResult->getWallet());
    	$this->assertInstanceOf(Investment::class, $this->fundTestResult->getInvestment());
    	$this->assertInstanceOf(Tranche::class, $this->fundTestResult->getTranche());
    }
}