<?php

declare(strict_types=1);

namespace AppTest\Unit\Repository;

use PHPUnit\Framework\TestCase;
use App\Entity\Wallet;
use App\Repository\WalletRepository;
use App\Entity\Investor;
use App\Entity\Fund;

class WalletRepositoryTest extends TestCase
{
	/** @var Wallet */
	private $walletTestResult;

	/**var array */
	private $testDataArray;

    public function setUp(): void
    {
        parent::setUp();
        $this->testDataArray = [
        	'id' => 'Test',
        	'created' => (new \DateTime())->setDate(2020, 12, 31),
            'investor' => new Investor(),
            'fund' => new Fund()
		];
		$walletRepositoryInstance = new WalletRepository((new Wallet()));
        $this->walletTestResult = $walletRepositoryInstance->create($this->testDataArray);
    }

   	public function testAbstractParentClassValueProperty()
    {
    	$this->assertEquals($this->testDataArray['id'], $this->walletTestResult->getId());
    	$this->assertEquals($this->testDataArray['created'], $this->walletTestResult->getCreated());
    }

    public function testEntityRelationshipValueProperty()
    {
    	$this->assertInstanceOf(Investor::class, $this->walletTestResult->getInvestor());
        $this->assertInstanceOf(Fund::class, $this->walletTestResult->getFund());
    }
}