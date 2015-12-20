<?php

namespace EbayBase\Configuration;

use EbayBase\Exception\ConfigurationException;
use EbayBase\Paginator\Paginator;
use EbayBase\Paginator\Sorter;

class Configuration implements ConfigurationInterface
{
    private $operationName;
    private $serviceVersion;
    private $securityAppname;
    private $globalId;
    private $endpoint;
    private $pagination;
    private $requestMethod;
    private $transferType;
    private $sort;

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
     * @param int $entriesPerPage
     * @param int $pageNumber
     */
    public function setPagination($entriesPerPage = 10, $pageNumber = 1)
    {
        $this->pagination = new Paginator($entriesPerPage, $pageNumber);

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
     * @param string $sort
     */
    public function sortBy($sort)
    {
        $this->sort = new Sorter($sort);

        return $this;
    }

    /**
     * @returns string
     */
    public function getSorted()
    {
        $this->sort->getSorted();
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
     * @returns bool
     *
     * @throws \EbayBase\Exception\ConfigurationException
     */
    public function validate()
    {
        $validOperationNames = array(
            'findItemsByKeywords',
            'findItemsAdvanced',
        );

        if (in_array($this->operationName, $validOperationNames) === false) {
            throw new ConfigurationException('Invalid operation name. Valid operations are '.implode(',', $validOperationNames));
        }

        if ($this->serviceVersion !== '1.0.0') {
            throw new ConfigurationException('Invalid service version. Service version can only be 1.0.0');
        }

        if (!is_string($this->securityAppname)) {
            throw new ConfigurationException('Invalid security appname. Security appname has to be a string');
        }

        if (!is_string($this->globalId)) {
            throw new ConfigurationException('Invalid GLOBAL-ID. GLOBAL-ID has to be a string');
        }

        if (!is_string($this->endpoint)) {
            throw new ConfigurationException('Invalid endpoint. Endpoint has to be a string');
        }

        if (!is_string($this->requestMethod)) {
            throw new ConfigurationException('Invalid request method. Request method can be GET or POST');
        }

        $requestMethod = strtolower($this->requestMethod);

        if ($requestMethod !== 'post' and $requestMethod !== 'get') {
            throw new ConfigurationException('Configuration value reguest-method can only be GET or POST');
        }

        $transferType = strtolower($this->transferType);

        if ($transferType !== 'url' and $transferType !== 'xml') {
            throw new ConfigurationException('Configuration value transfer-type can only be url or xml');
        }

        if ($transferType === 'url' and $requestMethod === 'post') {
            throw new ConfigurationException('If request-method is POST, then transfer-type has to be xml');
        }

        if ($transferType === 'xml' and $requestMethod === 'get') {
            throw new ConfigurationException('If request-method is GET, then transfer-type has to be url');
        }
    }
}