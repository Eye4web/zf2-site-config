<?php

/*
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR
 * A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT
 * OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL,
 * SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT
 * LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE,
 * DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY
 * THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
 * OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 * This software consists of voluntary contributions made by many individuals
 * and is licensed under the MIT license.
 */

namespace Eye4web\SiteConfigTest\Factory\Config;

use Eye4web\SiteConfig\Config\Config;
use Eye4web\SiteConfig\Factory\Config\ConfigFactory;
use Eye4web\SiteConfig\Options\ModuleOptions;
use Eye4web\SiteConfig\Reader\ReaderInterface;
use Zend\Config\Factory as ZendConfigFactory;
use Zend\ServiceManager\ServiceLocatorInterface;

class ConfigFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testGetConfigFromFile()
    {
        $options = $this->getMockBuilder(ModuleOptions::class)
            ->disableOriginalConstructor()
            ->getMock();
        $serviceLocator = $this->getMockBuilder(ServiceLocatorInterface::class)
            ->disableOriginalConstructor()
            ->getMock();
        $configFile = 'someConfigFile.ext';
        $expectedResult = ['array' => 'of', 'config' => 'values'];
        $zendConfigFactory = new ZendConfigFactoryFake($expectedResult);

        $serviceLocator->expects($this->at(0))
            ->method('get')
            ->with(ModuleOptions::class)
            ->will($this->returnValue($options));

        $options->expects($this->once())
            ->method('getConfigFile')
            ->will($this->returnValue($configFile));

        $factory = new ConfigFactory();
        $factory->setConfigFactory($zendConfigFactory);
        $result = $factory->createService($serviceLocator);
        $this->assertInstanceOf(Config::class, $result);
        $this->assertSame($expectedResult, $result->toArray());
    }

    public function testGetConfigFromReader()
    {
        $options = $this->getMockBuilder(ModuleOptions::class)
            ->disableOriginalConstructor()
            ->getMock();
        $serviceLocator = $this->getMockBuilder(ServiceLocatorInterface::class)
            ->disableOriginalConstructor()
            ->getMock();
        $configFile = null;
        $expectedResult = ['array' => 'of', 'config' => 'values'];
        $zendConfigFactory = new ZendConfigFactoryFake($expectedResult);
        $readerClass = 'Some\Reader\Class';
        $reader = $this->getMockBuilder(ReaderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $serviceLocator->expects($this->at(0))
            ->method('get')
            ->with(ModuleOptions::class)
            ->will($this->returnValue($options));

        $options->expects($this->once())
            ->method('getReaderClass')
            ->will($this->returnValue($readerClass));

        $serviceLocator->expects($this->at(1))
            ->method('get')
            ->with($readerClass)
            ->will($this->returnValue($reader));

        $reader->expects($this->once())
            ->method('getArray')
            ->will($this->returnValue($expectedResult));

        $factory = new ConfigFactory();
        $factory->setConfigFactory($zendConfigFactory);
        $result = $factory->createService($serviceLocator);
        $this->assertInstanceOf(Config::class, $result);
        $this->assertSame($expectedResult, $result->toArray());
    }

    public function testReaderDoesntImplementInterface()
    {
        $options = $this->getMockBuilder(ModuleOptions::class)
            ->disableOriginalConstructor()
            ->getMock();
        $serviceLocator = $this->getMockBuilder(ServiceLocatorInterface::class)
            ->disableOriginalConstructor()
            ->getMock();
        $configFile = null;
        $expectedResult = ['array' => 'of', 'config' => 'values'];
        $zendConfigFactory = new ZendConfigFactoryFake($expectedResult);
        $readerClass = 'Wrong\Reader\Class';
        $notAReader = $this->getMockBuilder(ZendConfigFactoryFake::class)
            ->disableOriginalConstructor()
            ->getMock();

        $serviceLocator->expects($this->at(0))
            ->method('get')
            ->with(ModuleOptions::class)
            ->will($this->returnValue($options));

        $options->expects($this->once())
            ->method('getReaderClass')
            ->will($this->returnValue($readerClass));

        $serviceLocator->expects($this->at(1))
            ->method('get')
            ->with($readerClass)
            ->will($this->returnValue($notAReader));

        $this->setExpectedException('Exception');

        $factory = new ConfigFactory();
        $factory->setConfigFactory($zendConfigFactory);
        $factory->createService($serviceLocator);
    }

    public function testNoDataReturned()
    {
        $options = $this->getMockBuilder(ModuleOptions::class)
            ->disableOriginalConstructor()
            ->getMock();
        $serviceLocator = $this->getMockBuilder(ServiceLocatorInterface::class)
            ->disableOriginalConstructor()
            ->getMock();
        $configFile = null;
        $expectedResult = null;
        $zendConfigFactory = new ZendConfigFactoryFake($expectedResult);
        $readerClass = 'Some\Reader\Class';
        $reader = $this->getMockBuilder(ReaderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $serviceLocator->expects($this->at(0))
            ->method('get')
            ->with(ModuleOptions::class)
            ->will($this->returnValue($options));

        $options->expects($this->once())
            ->method('getReaderClass')
            ->will($this->returnValue($readerClass));

        $serviceLocator->expects($this->at(1))
            ->method('get')
            ->with($readerClass)
            ->will($this->returnValue($reader));

        $reader->expects($this->once())
            ->method('getArray')
            ->will($this->returnValue($expectedResult));

        $this->setExpectedException('Exception');

        $factory = new ConfigFactory();
        $factory->setConfigFactory($zendConfigFactory);
        $factory->createService($serviceLocator);
    }

    public function testGetConfigFactoryWithoutSetFactory()
    {
        $factory = new ConfigFactory();
        $result = $factory->getConfigFactory();

        $this->assertInstanceOf(ZendConfigFactory::class, $result);
    }

    public function testSetConfigFactory()
    {
        $zendFactory = new ZendConfigFactory();
        $factory = new ConfigFactory();
        $factory->setConfigFactory($zendFactory);
        $result = $factory->getConfigFactory();

        $this->assertSame($zendFactory, $result);
    }
}
