<?php

declare(strict_types=1);

namespace App\Helper\Interest;

use App\Request\RequestInterface;

interface InterestInterface
{
	/**
     * @param RequestInterface $request
     *
     * @return array
     */
    public function handle(RequestInterface $request): array;
}