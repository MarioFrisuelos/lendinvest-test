<?php

declare(strict_types=1);

namespace App\Entity;

interface BaseEntityInterface
{
    /**
     * @return mixed
     */
    public function getId();

    /**
     * @return \DateTime
     */
    public function getCreated(): \DateTime;

    /**
     * @param \DateTime $created
     *
     * @return BaseEntity
     */
    public function setCreated(\DateTime $created);

    /**
     * @return \DateTime
     */
    public function getUpdated(): \DateTime;

    /**
     * @param \DateTime $updated
     *
     * @return BaseEntity
     */
    public function setUpdated(\DateTime $updated);
}