<?php

declare(strict_types=1);

namespace App\Request;

class CalculateInterestRequest implements RequestInterface
{
	/** @var DateTime */
	private $startDate;

	/** @var DateTime */
	private $endDate;

	/** @var array */
	private $investments;

	/**
     * @param DateTime $amountToInvest
     * @param DateTime $investor
     */
	function __construct(
		\DateTime $startDate, 
		\DateTime $endDate,
		array $investments
	) {
		$this->startDate = $startDate;
		$this->endDate = $endDate;
		$this->investments = $investments;
	}

	/**
	 * @return DateTime
	 */
    public function getStartDate(): \DateTime
    {
    	return $this->startDate;
    }

	/**
	 * @return DateTime
	 */
    public function getEndDate(): \DateTime
    {
    	return $this->endDate;
    }

   	/**
	 * @return array
	 */
    public function getInvestments(): array
    {
    	return $this->investments;
    }
}