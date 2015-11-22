<?php

namespace EbayBase;

use EbayBase\Exception\ConfigurationException;

class Factory
{
    private $factoryClosures;
    private $decidingArgument;
    private $arguments;
    private $factoryCreator;

    private $objects = array();

    private static $instance;

    /**
     * @param array $factoryClosures
     */
    public static function construct(array $factoryClosures)
    {
        self::$instance =
            (self::$instance instanceof self) ?
                self::$instance :
                new Factory($factoryClosures);

        return self::$instance;
    }

    /**
     * @param array $factoryClosures
     */
    public function __construct(array $factoryClosures)
    {
        $this->factoryClosures = $factoryClosures;
    }

    /**
     * @param array $dependencies
     */
    public function setDependencies(array $dependencies)
    {
        $this->factoryClosures = $dependencies;
    }

    /**
     * @param array $arguments
     *
     * @return $this
     */
    public function setArguments(array $arguments)
    {
        $this->arguments = $arguments;

        return $this;
    }

    /**
     * @param $decidingArgument
     *
     * @return $this
     */
    public function setDecidingArgument($decidingArgument)
    {
        $this->decidingArgument = $decidingArgument;

        return $this;
    }

    /**
     * @param \Closure $factoryCreator
     *
     * @return $this
     */
    public function setFactoryCreator(\Closure $factoryCreator)
    {
        $this->factoryCreator = $factoryCreator;

        return $this;
    }

    /**
     * @param bool $isSingelton
     *
     * @return mixed
     *
     * @throws ConfigurationException
     */
    public function create($isSingelton = true)
    {
        if ($isSingelton === true) {
            if (!array_key_exists($this->decidingArgument, $this->objects)) {
                $factoryCreator = $this->factoryCreator;

                $this->objects[$this->decidingArgument] = $factoryCreator($this->factoryClosures, $this->decidingArgument, $this->arguments);

                return $this->objects[$this->decidingArgument];
            }

            return $this->objects[$this->decidingArgument];
        }

        if ($isSingelton === false) {
            return $this->factoryCreator($this->factoryClosures, $this->decidingArgument, $this->arguments);
        }

        throw new ConfigurationException('ConstructorFactory::create() argument has to be a boolean of true or false');
    }
}