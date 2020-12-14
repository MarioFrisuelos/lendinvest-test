<?php

declare(strict_types=1);

namespace App\Entity;

use Faker\Provider\Uuid;

abstract class BaseEntity implements BaseEntityInterface
{
    /** @var string */
    protected $id;

    /** @var DateTime */
    protected $created;

    /** @var DateTime */
    protected $updated;

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param null|string $id
     *
     * @throws \Exception
     */
    public function setId($id = null)
    {
        if (empty($id)) {
            $this->id = Uuid::uuid();

            return;
        }
        $this->id = $id;
    }

    /**
     * @return \DateTime
     */
    public function getCreated(): \DateTime
    {
        return $this->created;
    }

    /**
     * @param \DateTime $created
     *
     * @throws \Exception
     */
    public function setCreated(\DateTime $created = null)
    {
        if (empty($created)) {
            $this->created = new \DateTime();

            return;
        }
        $this->created = $created;
    }

    /**
     * @return \DateTime
     */
    public function getUpdated(): \DateTime
    {
        return $this->updated;
    }

    /**
     * @param \DateTime $updated
     */
    public function setUpdated(\DateTime $updated): void
    {
        $this->updated = $updated;
    }
}