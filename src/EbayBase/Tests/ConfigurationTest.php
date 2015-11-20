<?php

namespace EbayBase\Tests;

use EbayBase\Configuration\Configuration;

class ConfigurationTest extends \PHPUnit_Framework_TestCase
{
    public function testConfiguration()
    {
        $configuration = new Configuration(array(
            'endpoint' => 'http://svcs.ebay.com/services/search/FindingService/v1',
            'operation-name' => 'findItemsByKeywords',
            'service-version' => '1.0.0',
            'security-appname' => 'Mariokrl-639a-4ff6-bd2e-4ff5444209a6',
            'global-id' => 'EBAY-US',
            'request-method' => 'GET',
            'transfer-type' => 'url',
        ));

        $this->assertTrue($configuration->hasConfiguration('operation-name'), 'Invalid configuration operation-name');
        $this->assertTrue($configuration->hasConfiguration('service-version'), 'Invalid configuration service-version');
        $this->assertTrue($configuration->hasConfiguration('security-appname'), 'Invalid configuration security-appname');
        $this->assertTrue($configuration->hasConfiguration('global-id'), 'Invalid configuration global-id');
        $this->assertTrue($configuration->hasConfiguration('endpoint'), 'Invalid configuration endpoint');
        $this->assertTrue($configuration->hasConfiguration('pagination'), 'Invalid configuration pagination');
        $this->assertTrue($configuration->hasConfiguration('request-method'), 'Invalid configuration request-method');
        $this->assertTrue($configuration->hasConfiguration('transfer-type'), 'Invalid configuration transfer-type');

        $this->assertInternalType('string', $configuration->getConfiguration('operation-name'), 'operation-name has to be a string');
        $this->assertInternalType('string', $configuration->getConfiguration('service-version'), 'service-version has to be a string');
        $this->assertInternalType('string', $configuration->getConfiguration('security-appname'), 'security-appname has to be a string');
        $this->assertInternalType('string', $configuration->getConfiguration('global-id'), 'global-id has to be a string');
        $this->assertInternalType('string', $configuration->getConfiguration('endpoint'), 'endpoint has to be a string');
        $this->assertInternalType('string', $configuration->getConfiguration('pagination'), 'pagination has to be a string');
        $this->assertInternalType('string', $configuration->getConfiguration('transfer-type'), 'transfer-type has to be a string');

        return $configuration;
    }

}