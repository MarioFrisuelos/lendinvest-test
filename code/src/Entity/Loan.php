<?php

declare(strict_types=1);

namespace App\Entity;

class Loan extends BaseEntity
{
    /** @var DateTime */
	private $startDate;

    /** @var DateTime */
	private $endDate;

	/** @var array */
    private $tranche;

	function __construct()
	{
		$this->tranche = [];
	}

    /**
     * @return \DateTime
     */
    public function getStartDate(): \DateTime
    {
        return $this->startDate;
    }

    /**
     * @param \DateTime $startDate
     */
    public function setStartDate(\DateTime $startDate): void
    {
        $this->startDate = $startDate;
    }

    /**
     * @return \DateTime
     */
    public function getEndDate(): \DateTime
    {
        return $this->endDate;
    }

    /**
     * @param \DateTime $endDate
     */
    public function setEndDate(\DateTime $endDate): void
    {
        $this->endDate = $endDate;
    }

	/**
     * @return array
     */
    public function getTranche(): array
    {
        return $this->tranche;
    }

    /**
     * @param Tranche $tranche
     */
    public function addTranche(Tranche $tranche): void
    {
        $this->tranche[] = $tranche;
        $tranche->setLoan($this);
    }
}