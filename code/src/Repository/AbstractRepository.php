<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\BaseEntityInterface;

abstract class AbstractRepository
{
	/** @var BaseEntityInterface */
	protected $entity;

    /**
     * @param BaseEntityInterface $entity
     */
	function __construct(BaseEntityInterface $entity)
	{
		$this->entity = $entity;
	}

	/**
	 * @param array $parameters
	 *
     * @return BaseEntityInterface 
     */
	abstract public function create(array $parameters): BaseEntityInterface;

	abstract public function read();
	
	abstract public function update();
	
	abstract public function delete();

	/**
	 * @param array $parameters
	 *
     * @return BaseEntityInterface 
     */
	public function findBy(array $parameters): BaseEntityInterface
	{
	}
}