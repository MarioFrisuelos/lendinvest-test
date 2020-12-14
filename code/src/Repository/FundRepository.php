<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\BaseEntityInterface;

class FundRepository extends AbstractRepository
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
		$this->entity->setLiquidity($parameters['liquidity']);
		$this->entity->setCurrency($parameters['currency']);
		if (isset($parameters['wallet'])) {
			$this->entity->setWallet($parameters['wallet']);
		}
		if (isset($parameters['investment'])) {
			$this->entity->setInvestment($parameters['investment']);
		}
		if (isset($parameters['tranche'])) {
			$this->entity->setTranche($parameters['tranche']);
		}

		return $this->entity;
	}

	public function read(){}
	public function update(){}
	public function delete(){}
}