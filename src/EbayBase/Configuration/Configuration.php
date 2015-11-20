<?php

namespace EbayBase\Configuration;

use EbayBase\Exception\ConfigurationException;

class Configuration implements \IteratorAggregate
{
    private $configuration;

    /**
     * @param array $configuration
     * @throws ConfigurationException
     */
    public function __construct(array $configuration)
    {
        $configuration = $this->addDefaults($configuration);

        $validity = array(
            'operation-name',
            'service-version',
            'security-appname',
            'global-id',
            'endpoint',
            'pagination',
            'request-method',
            'transfer-type',
        );

        foreach ($configuration as $configKey => $configValue) {
            if (in_array($configKey, $validity) === false) {
                throw new ConfigurationException("Configuration value ".$configKey." is not a valid configuration value. Allowed configuration is: operation-name, service-version, security-appname, global-id, endpoint, pagination");
            }
        }

        $requestMethod = strtolower($configuration['request-method']);

        if ($requestMethod !== 'post' and $requestMethod !== 'get') {
            throw new ConfigurationException('Configuration value reguest-method can only be GET or POST');
        }

        $transferType = strtolower($configuration['transfer-type']);

        if ($transferType !== 'url' and $transferType !== 'xml') {
            throw new ConfigurationException('Configuration value transfer-type can only be url or xml');
        }

        if ($transferType === 'url' and $requestMethod === 'post') {
            throw new ConfigurationException('If request-method is POST, then transfer-type has to be xml');
        }

        if ($transferType === 'xml' and $requestMethod === 'get') {
            throw new ConfigurationException('If request-method is GET, then transfer-type has to be url');
        }

        $this->configuration = $configuration;
    }

    /**
     * @param $configValue
     * @return bool
     */
    public function hasConfiguration($configValue)
    {
        return array_key_exists($configValue, $this->configuration);
    }

    /**
     * @param null $configValue
     * @return array
     */
    public function getConfiguration($configValue = null)
    {
        if ($configValue === null) {
            return $this->configuration;
        }

        if ($this->hasConfiguration($configValue)) {
            return $this->configuration[$configValue];
        }

        return null;
    }

    /**
     * @param array $configuration
     * @return Configuration
     */
    public function setConfiguration(array $configuration)
    {
        $this->configuration = $configuration;

        return $this;
    }

    /**
     * @return array
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->configuration);
    }

    private function addDefaults(array $configuration)
    {
        if (!array_key_exists('pagination', $configuration)) {
            $configuration['pagination'] = '3';
        }

        if (!array_key_exists('endpoint', $configuration)) {
            $configuration['endpoint'] = 'http://svcs.ebay.com/services/search/FindingService/v1';
        }

        return $configuration;
    }
}