<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\BaseEntityInterface;

class LoanRepository extends AbstractRepository
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
		$this->entity->setStartDate($parameters['startDate']);
		$this->entity->setEndDate($parameters['endDate']);
		if (isset($parameters['tranche'])) {
			$this->entity->addTranche($parameters['tranche']);
		}

		return $this->entity;
	}

	public function read(){}
	public function update(){}
	public function delete(){}
}