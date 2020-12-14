<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\BaseEntityInterface;

class TrancheRepository extends AbstractRepository
{
	/**
	 * @param array $parameters
	 *
     * @return BaseEntityInterface 
     */
	public function create(array $parameters): BaseEntityInterface
	{
		$this->entity->setId($parameters['id']);
		$this->entity->setCreated($parameters['created']);
		$this->entity->setInterestRate($parameters['interestRate']);
		$this->entity->setName($parameters['name']);
		if (isset($parameters['fund'])) {
			$this->entity->setFund($parameters['fund']);
		}
		if (isset($parameters['loan'])) {
			$this->entity->setLoan($parameters['loan']);
		}

		return $this->entity;
	}

	public function read(){}
	public function update(){}
	public function delete(){}
}