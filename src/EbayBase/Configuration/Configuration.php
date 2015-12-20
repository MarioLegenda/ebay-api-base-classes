<?php

namespace EbayBase\Configuration;

use EbayBase\Exception\ConfigurationException;

class Configuration implements \IteratorAggregate
{
    private $configuration;

    private $operationName;
    private $serviceVersion;
    private $securityAppname;
    private $globalId;
    private $endpoint;
    private $pagination;
    private $requestMethod;
    private $transferType;

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
     * @param $operationName
     * @return $this
     */
    public function setOperationName($operationName)
    {
        $this->operationName = $operationName;

        return $this;
    }
    /**
     * @return mixed
     */
    public function getOperationName()
    {
        return $this->operationName;
    }

    /**
     * @param $endpoint
     * @return $this
     */
    public function setEndpoint($endpoint)
    {
        $this->endpoint = $endpoint;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getEndpoint()
    {
        return $this->endpoint;
    }

    /**
     * @param $serviceVersion
     * @return $this
     */
    public function setServiceVersion($serviceVersion)
    {
        $this->serviceVersion = $serviceVersion;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getServiceVersion()
    {
        return $this->serviceVersion;
    }

    /**
     * @param $securityAppname
     * @return $this
     */
    public function setSecurityAppname($securityAppname)
    {
        $this->securityAppname = $securityAppname;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getSecurityAppname()
    {
        return $this->securityAppname;
    }

    /**
     * @param $globalId
     * @return $this
     */
    public function setGlobalId($globalId)
    {
        $this->globalId = $globalId;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getGlobalId()
    {
        return $this->globalId;
    }

    /**
     * @param $pagination
     * @return $this
     */
    public function setPagination($pagination)
    {
        $this->pagination = $pagination;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPagination()
    {
        return $this->pagination;
    }

    /**
     * @param $requestMethod
     * @return $this
     */
    public function setRequestMethod($requestMethod)
    {
        $this->requestMethod = $requestMethod;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getRequestMethod()
    {
        return $this->requestMethod;
    }

    /**
     * @param $transferType
     * @return $this
     */
    public function setTransferType($transferType)
    {
        $this->transferType = $transferType;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getTransferType()
    {
        return $this->transferType;
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