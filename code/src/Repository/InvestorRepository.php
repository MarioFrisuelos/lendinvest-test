<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\BaseEntityInterface;

class InvestorRepository extends AbstractRepository
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
		$this->entity->setname($parameters['name']);
		$this->entity->addWallet($parameters['wallet']);
		if (isset($parameters['investment'])) {
			$this->entity->addInvestment($parameters['investment']);
		}

		return $this->entity;
	}

	public function read(){}
	public function update(){}
	public function delete(){}
}