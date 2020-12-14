<?php

declare(strict_types=1);

namespace App\Entity;

class Wallet extends BaseEntity
{
	/** @var Investor */
    private $investor;

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
        $fund->setWallet($this);
    }
}