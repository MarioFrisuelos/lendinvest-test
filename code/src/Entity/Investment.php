<?php

declare(strict_types=1);

namespace App\Entity;

class Investment extends BaseEntity
{
	/** @var Investor */
    private $investor;

    /** @var Tranche */
    private $tranche;

	/** @var Fund */
    private $fund;

   	/**
     * @return Investor
     */
    public function getInvestor(): Investor
    {
        return $this->investor;
    }

    /**
     * @param Investor $investor
     */
    public function setInvestor(Investor $investor): void
    {
        $this->investor = $investor;
    }

    /**
     * @return Tranche
     */
    public function getTranche(): Tranche
    {
        return $this->tranche;
    }

    /**
     * @param Tranche $tranche
     */
    public function setTranche(Tranche $tranche): void
    {
        $this->tranche = $tranche;
    }

    /**
     * @return Fund 
     */
    public function getFund(): Fund
    {
        return $this->fund;
    }

    /**
     * @param Fund $fund
     */
    public function setFund(Fund $fund): void
    {
        $this->fund = $fund;
        $fund->setInvestment($this);
    }
}