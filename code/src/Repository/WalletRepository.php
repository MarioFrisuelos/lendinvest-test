<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\BaseEntityInterface;

class WalletRepository extends AbstractRepository
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
		if (isset($parameters['investor'])) {
			$this->entity->setInvestor($parameters['investor']);
		} 
		$this->entity->setFund($parameters['fund']);

		return $this->entity;
	}

	public function read(){}
	public function update(){}
	public function delete(){}
}