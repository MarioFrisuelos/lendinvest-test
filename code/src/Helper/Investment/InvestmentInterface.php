<?php

declare(strict_types=1);

namespace App\Helper\Investment;

use App\Request\RequestInterface;
use App\Entity\BaseEntityInterface;

interface InvestmentInterface
{
	/**
     * @param RequestInterface $request
     *
     * @return BaseEntityInterface
     */
    public function handle(RequestInterface $request): BaseEntityInterface;
}