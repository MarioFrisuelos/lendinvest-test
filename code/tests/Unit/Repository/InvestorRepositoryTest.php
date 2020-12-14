<?php

declare(strict_types=1);

namespace AppTest\Unit\Repository;

use PHPUnit\Framework\TestCase;
use App\Entity\Investor;
use App\Repository\InvestorRepository;
use App\Entity\Wallet;
use App\Entity\Investment;

class InvestorRepositoryTest extends TestCase
{
	/** @var Investor */
	private $investorTestResult;

	/**var array */
	private $testDataArray;

    public function setUp(): void
    {
        parent::setUp();
        $this->testDataArray = [
        	'id' => 'Test',
        	'created' => (new \DateTime())->setDate(2020, 12, 31),
            'name' => "The Investor Is The Name",
            'wallet' => new Wallet(),
            'investment' => new Investment()
		];
		$investorRepositoryInstance = new InvestorRepository((new Investor()));
        $this->investorTestResult = $investorRepositoryInstance->create($this->testDataArray);
    }

   	public function testAbstractParentClassValueProperty()
    {
    	$this->assertEquals($this->testDataArray['id'], $this->investorTestResult->getId());
    	$this->assertEquals($this->testDataArray['created'], $this->investorTestResult->getCreated());
    }

    public function testEntityRelationshipValueProperty()
    {
        $this->assertInstanceOf(Wallet::class, $this->investorTestResult->getWallet()[0]);
        $this->assertInstanceOf(Investment::class, $this->investorTestResult->getInvestment()[0]);
    }
}