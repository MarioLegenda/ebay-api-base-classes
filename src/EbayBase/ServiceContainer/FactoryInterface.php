<?php

namespace EbayBase\ServiceContainer;

interface FactoryInterface
{
    /**
     * @param array $dependencies
     * @return mixed
     */
    public function create(array $dependencies = null);
}