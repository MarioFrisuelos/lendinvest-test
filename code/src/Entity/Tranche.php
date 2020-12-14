<?php

declare(strict_types=1);

namespace App\Entity;

class Tranche extends BaseEntity
{
	/** @var float */
	private $interestRate;

    /** @var string */
    private $name;

    /** 
     * Description: This variable represent the max amount of money 
     * available to invest in one specific tranche.
     * 
     * @var Fund 
     */
	private $fund;

	/** @var Loan */
    private $loan;

    /**
     * @return float
     */
    public function getInterestRate(): float
    {
        return $this->interestRate;
    }

    /**
     * @param float $interestRate
     */
    public function setInterestRate(float $interestRate): void
    {
        $this->interestRate = $interestRate;
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
        $fund->setTranche($this);
    }

    /**
     * @return Loan
     */
    public function getLoan(): Loan
    {
        return $this->loan;
    }

    /**
     * @param Loan $loan
     */
    public function setLoan(Loan $loan): void
    {
        $this->loan = $loan;
    }
}