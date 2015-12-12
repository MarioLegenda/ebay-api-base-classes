<?php

namespace EbayBase\ServiceContainer;

use EbayBase\ServiceContainer\FactoryInterface;
use EbayBase\Exception\ArgumentException;

class FactoryContainer
{
    /**
     * @var array|null
     */
    private $factories;
    /**
     * @var null
     */
    private $arguments;
    /**
     * @param array $factories
     */
    public function __construct(array $factories = array())
    {
        if (!$factories) {
            $this->factories = array();
        }

        if (is_array($factories) and !empty($factories)) {
            foreach ($factories as $factory) {
                if (!$factory instanceof FactoryInterface) {
                    throw new ArgumentException('FactoryContainer: __construct() argument has to be an array of FactoryInterface(s)');
                }
            }
        }

        $this->factories = $factories;
        $this->arguments = null;
    }
    /**
     * @param string $key
     * @param FactoryInterface $factory
     *
     * @return $this;
     * @throws ArgumentException
     */
    public function add($key, FactoryInterface $factory)
    {
        if (!$this->has($key)) {
            $this->factories[$key] = $factory;

            return $this;
        }

        throw new ArgumentException('FactoryContainer: Already added key '.$key);
    }
    /**
     * @param string $key
     *
     * @return mixed
     *
     * @throws ArgumentException
     */
    public function create($key)
    {
        if (!$this->has($key)) {
            throw new ArgumentException('FactoryContainer: Cannot create object with key '.$key.'. Key not found');
        }

        $factory = $this->factories[$key];

        if ($this->arguments) {
            return $factory->create($this->arguments);
        }

        return $factory->create();
    }
    /**
     * @param string $key
     *
     * @return bool
     */
    public function has($key)
    {
        return array_key_exists($key, $this->factories);
    }

    /**
     * @param array $arguments
     *
     * @throws ArgumentException
     *
     * @return $this
     */
    public function withArguments(array $arguments)
    {
        if (empty($arguments)) {
            throw new ArgumentException('FactoryContainer: If provided, arguments cannot be an empty value');
        }

        $this->arguments = $arguments;

        return $this;
    }
}