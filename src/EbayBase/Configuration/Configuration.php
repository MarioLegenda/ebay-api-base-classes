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
        );

        foreach ($configuration as $configKey => $configValue) {
            if (in_array($configKey, $validity) === false) {
                throw new ConfigurationException("Configuration value ".$configValue." is not a valid configuration value. Allowed configuration is: operation-name, service-version, security-appname, global-id, endpoint, pagination");
            }
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
     * @param $endpoint
     */
    public function setEndpoint($endpoint)
    {
        $this->configuration['endpoint'] = $endpoint;
    }

    /**
     * @return array|null
     */
    public function getEndpoint()
    {
        if ($this->hasConfiguration('endpoint')) {
            return $this->getConfiguration('endpoint');
        }

        return null;
    }

    /**
     * @param $operationName
     */
    public function setOperationName($operationName)
    {
        $this->configuration['operation-name'] = $operationName;

        return $this;
    }

    /**
     * @return array|null
     */
    public function getOperationName()
    {
        if ($this->hasConfiguration('operation-name')) {
            return $this->getConfiguration('operation-name');
        }

        return null;
    }

    /**
     * @param $serviceVersion
     */
    public function setServiceVersion($serviceVersion)
    {
        $this->configuration['service-version'] = $serviceVersion;

        return $this;
    }

    /**
     * @return array|null
     */
    public function getServiceVersion()
    {
        if ($this->hasConfiguration('service-version')) {
            return $this->getConfiguration('service-version');
        }

        return null;
    }

    /**
     * @param $appname
     */
    public function setSecurityAppName($appname)
    {
        $this->configuration['security-appname'] = $appname;

        return $this;
    }

    /**
     * @return array|null
     */
    public function getSecurityAppName()
    {
        if ($this->hasConfiguration('security-appname')) {
            return $this->getConfiguration('security-appname');
        }

        return null;
    }

    /**
     * @param $globalId
     */
    public function setGlobalId($globalId)
    {
        $this->configuration['global-id'] = $globalId;

        return $this;
    }

    /**
     * @return array|null
     */
    public function getGlobalId()
    {
        if ($this->hasConfiguration('global-id')) {
            return $this->getConfiguration('global-id');
        }

        return null;
    }

    /**
     * @param $pagination
     * @throws ConfigurationException
     */
    public function setPagination($pagination)
    {
        $this->configuration['pagination'] = $pagination;
    }

    /**
     * @return array|null
     */
    public function getPagination()
    {
        if ($this->hasConfiguration('pagination')) {
            return $this->getConfiguration('pagination');
        }

        return null;
    }

    /**
     * @return array
     */
    public function getIterator()
    {
        return $this->configuration;
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