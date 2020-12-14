<?php

declare(strict_types=1);

namespace App\Entity;

class Fund extends BaseEntity
{
	/** @var float */
	private $liquidity; 

	/** @var string */
	private $currency;

	/** @var Wallet */
	private $wallet;

	/** @var Investment */
	private $investment;

    /** @var Tranche */
    private $tranche;

	/**
     * @return float
     */
    public function getLiquidity(): float
    {
        return $this->liquidity;
    }

    /**
     * @param float $liquidity
     */
    public function setLiquidity(float $liquidity): void
    {
		$this->liquidity = $liquidity;
    }

	/**
     * @return string
     */
    public function getCurrency(): string
    {
        return $this->currency;
    }

    /**
     * @param string $currency
     */
    public function setCurrency(string $currency): void
    {
		$this->currency = $currency;
    }

    /**
     * @return Wallet
     */
    public function getWallet(): Wallet
    {
        return $this->wallet;
    }

    /**
     * @param Wallet $wallet
     */
    public function setWallet(Wallet $wallet): void
    {
        $this->wallet = $wallet;
    }

    /**
     * @return Investment
     */
    public function getInvestment(): Investment
    {
        return $this->investment;
    }

    /**
     * @param Investment $investment
     */
    public function setInvestment(Investment $investment): void
    {
        $this->investment = $investment;
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
}