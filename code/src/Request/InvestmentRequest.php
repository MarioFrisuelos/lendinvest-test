<?php

declare(strict_types=1);

namespace App\Request;

use App\Entity\Investor;
use App\Entity\Tranche;

class InvestmentRequest implements RequestInterface
{
	/** @var float */
	private $amountToInvest; 

    /** @var DateTime */
    protected $created;

	/** @var Investor*/
	private $investor;

	/** @var Tranche */
	private $tranche;

    /**
     * @param float $amountToInvest
     * @param DateTime $created
     * @param Investor $investor
     * @param Tranche $tranche
     */
	function __construct(
		float $amountToInvest,
		\DateTime $created,
		Investor $investor,
		Tranche $tranche
	) {
		$this->amountToInvest = $amountToInvest;
		$this->created = $created;
		$this->investor = $investor;
		$this->tranche = $tranche;
	}

    /**
     * @return float
     */
	public function getAmountToInvest(): float
	{
		return $this->amountToInvest;
	}

	/**
     * @return \DateTime
     */
    public function getCreated(): \DateTime
    {
        return $this->created;
    }

	/**
     * @return Investor
     */
    public function getInvestor(): Investor
	{
		return $this->investor;
	}

	/**
     * @return Tranche
     */
	public function getTranche(): Tranche
	{
		return $this->tranche;
	}
}