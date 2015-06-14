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
namespace Eye4web\SiteConfigTest\Service;

use Eye4web\SiteConfig\Config\Config;
use Eye4web\SiteConfig\Config\ConfigInterface;
use Eye4web\SiteConfig\Factory\Config\ConfigFactory;
use Eye4web\SiteConfig\Options\ModuleOptions;
use Eye4web\SiteConfig\Reader\ReaderInterface;
use Eye4web\SiteConfig\Service\SiteConfigService;
use Zend\Config\Factory;
use Zend\ServiceManager\ServiceLocatorInterface;

class SiteConfigServiceTest extends \PHPUnit_Framework_TestCase
{
    public function testGetNoDefault()
    {
        $config = $this->getMockBuilder(ConfigInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $key = 'someConfigKey';
        $expectedResult = 'someConfigValue';

        $config->expects($this->once())
            ->method('get')
            ->with($key, null)
            ->will($this->returnValue($expectedResult));

        $service = new SiteConfigService($config);
        $result = $service->get($key);
        $this->assertSame($expectedResult, $result);
    }

    public function testGetWithDefault()
    {
        $config = $this->getMockBuilder(ConfigInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $key = 'someConfigKey';
        $default = 'defaultConfigValue';
        $expectedResult = 'someConfigValue';

        $config->expects($this->once())
            ->method('get')
            ->with($key, $default)
            ->will($this->returnValue($expectedResult));

        $service = new SiteConfigService($config);
        $result = $service->get($key, $default);
        $this->assertSame($expectedResult, $result);
    }

    public function testGetAll()
    {
        $config = $this->getMockBuilder(ConfigInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $expectedResult = ['lots' => 'of', 'config' => 'values'];

        $config->expects($this->once())
            ->method('toArray')
            ->will($this->returnValue($expectedResult));

        $service = new SiteConfigService($config);
        $result = $service->getAll();
        $this->assertSame($expectedResult, $result);
    }
}
