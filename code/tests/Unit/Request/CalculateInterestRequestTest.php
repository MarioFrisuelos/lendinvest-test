<?php

declare(strict_types=1);

namespace AppTest\Unit\Request;

use PHPUnit\Framework\TestCase;
use App\Request\CalculateInterestRequest;

class CalculateInterestRequestTest extends TestCase
{
	/** @var CalculateInterestRequest */
	private $calculateInterestRequest;

    /** @var array */
    private $testDataArray;

    public function setUp(): void
    {
        parent::setUp();
        $this->testDataArray = [
            'startDate' => (new \DateTime())->setDate(2020, 12, 31),
            'endDate' => (new \DateTime())->setDate(2023, 12, 31),
            'investments' => []
        ];
        $this->calculateInterestRequest = new CalculateInterestRequest(
            $this->testDataArray['startDate'], 
            $this->testDataArray['endDate'],
            $this->testDataArray['investments']
        );
    }

    public function testValidateStartEndDatetimeValueProperty()
    {
    	$this->assertInstanceOf(\DateTime::class, $this->calculateInterestRequest->getStartDate());
        $this->assertEquals($this->testDataArray['startDate'], $this->calculateInterestRequest->getStartDate());
        $this->assertInstanceOf(\DateTime::class, $this->calculateInterestRequest->getEndDate());
        $this->assertEquals($this->testDataArray['endDate'], $this->calculateInterestRequest->getEndDate());
    }

    public function testValidateInvestmentsValuePropertyIsAnArray()
    {
        $this->assertIsArray($this->calculateInterestRequest->getInvestments());
    }
}