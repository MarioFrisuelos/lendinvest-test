<?php

declare(strict_types=1);

namespace App\Entity;

class Investor extends BaseEntity
{
	/** @var string */
	private $name;

	/** @var array */
	private $wallet;

	/** @var array */
	private $investment;

	function __construct()
	{
		$this->wallet = [];
		$this->investment = [];
	}

	/**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return array
     */
    public function getWallet(): array
    {
        return $this->wallet;
    }

    /**
     * @param Wallet $wallet
     */
    public function addWallet(Wallet $wallet): void
    {
        $this->wallet[] = $wallet;
        $wallet->setInvestor($this);
    }

 	/**
     * @return array
     */
    public function getInvestment(): array
    {
        return $this->investment;
    }

    /**
     * @param Investment $investment
     */
    public function addInvestment(Investment $investment): void
    {
        $this->investment[] = $investment;
        $investment->setInvestor($this);
    }
}