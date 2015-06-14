<?php

namespace Eye4web\SiteConfigTest\Test\Controller\Plugin;

use Eye4web\SiteConfig\Controller\Plugin\SiteConfigPlugin;
use Eye4web\SiteConfig\Service\SiteConfigService;

class SiteConfigPluginTest extends \PHPUnit_Framework_TestCase
{
    protected $controllerPlugin;

    protected $siteConfigService;

    public function setUp()
    {
        $this->siteConfigService = $this->getMockBuilder(SiteConfigService::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->controllerPlugin = new SiteConfigPlugin($this->siteConfigService);
    }

    public function testInvoke()
    {
        $name = 'test-config';
        $expectedResult = 'config-value';

        $this->siteConfigService->expects($this->once())
            ->method('get')
            ->with($name, null)
            ->will($this->returnValue($expectedResult));

        $result = $this->controllerPlugin->__invoke($name);
        $this->assertSame($expectedResult, $result);
    }

    public function testCanInvokeWithoutDefault()
    {
        $name = 'test-config';
        $expectedResult = 'config-value';

        $this->siteConfigService->expects($this->once())
            ->method('get')
            ->with($name)
            ->will($this->returnValue($expectedResult));

        $result = $this->controllerPlugin->__invoke($name);
        $this->assertSame($expectedResult, $result);
    }
}
