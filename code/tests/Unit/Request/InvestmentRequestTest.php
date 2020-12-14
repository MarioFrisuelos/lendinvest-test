<?php

declare(strict_types=1);

namespace AppTest\Unit\Request;

use PHPUnit\Framework\TestCase;
use App\Request\InvestmentRequest;
use App\Entity\Investor;
use App\Entity\Tranche;

class InvestmentRequestTest extends TestCase
{
	/** @var InvestmentRequest */
	private $investmentRequest;

    /**var array */
    private $testDataArray;

    public function setUp(): void
    {
        parent::setUp();
        $this->testDataArray = [
            'amountToInvest' => 123.45,
            'created' => (new \DateTime())->setDate(2020, 10, 3),
            'investor' => new Investor(),
            'tranche' => new Tranche()
        ];
        $this->investmentRequest = new InvestmentRequest(
            $this->testDataArray['amountToInvest'], 
            $this->testDataArray['created'],
            $this->testDataArray['investor'], 
            $this->testDataArray['tranche']
        );
    }

    public function testAmountValueProperty()
    {
        $this->assertEquals($this->testDataArray['amountToInvest'], $this->investmentRequest->getAmountToInvest());
        $this->assertIsFloat($this->investmentRequest->getAmountToInvest());
    }

    public function testEntityRelationshipValueProperty()
    {
        $this->assertInstanceOf(Investor::class, $this->investmentRequest->getInvestor());
        $this->assertInstanceOf(Tranche::class, $this->investmentRequest->getTranche());
    }
}