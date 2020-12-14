<?php

declare(strict_types=1);

namespace AppTest\Unit\Repository;

use PHPUnit\Framework\TestCase;
use App\Entity\Loan;
use App\Repository\LoanRepository;
use App\Entity\Tranche;

class LoanRepositoryTest extends TestCase
{
	/** @var Loan */
	private $loanTestResult;

	/**var array */
	private $testDataArray;

    public function setUp(): void
    {
        parent::setUp();
        $this->testDataArray = [
        	'id' => 'Test',
        	'created' => (new \DateTime())->setDate(2020, 12, 31),
        	'startDate' => new \DateTime(),
        	'endDate' => (new \DateTime())->setDate(2030, 12, 31),
            'tranche' => new Tranche()
		];
		$loanRepositoryInstance = new LoanRepository((new Loan()));
        $this->loanTestResult = $loanRepositoryInstance->create($this->testDataArray);
    }

   	public function testAbstractParentClassValueProperty()
    {
    	$this->assertEquals($this->testDataArray['id'], $this->loanTestResult->getId());
    	$this->assertEquals($this->testDataArray['created'], $this->loanTestResult->getCreated());
    }

    public function testStartEndDatetimeValueProperty()
    {
        $this->assertEquals($this->testDataArray['startDate'], $this->loanTestResult->getStartDate());
        $this->assertEquals($this->testDataArray['endDate'], $this->loanTestResult->getEndDate());
    }

    public function testEntityRelationshipValueProperty()
    {
        $this->assertInstanceOf(Tranche::class, $this->loanTestResult->getTranche()[0]);
    }
}