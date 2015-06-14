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
use Eye4web\SiteConfig\Service\SiteConfigAwareTrait;
use Eye4web\SiteConfig\Service\SiteConfigService;
use Zend\Config\Factory;
use Zend\ServiceManager\ServiceLocatorInterface;

class SiteConfigAwareTraitTest extends \PHPUnit_Framework_TestCase
{
    public function testTrait()
    {
        $trait                = $this->getObjectForTrait(SiteConfigAwareTrait::class);
        $siteConfigService = $this->getMock(SiteConfigService::class, [], [], '', false);

        $trait->setSiteConfigService($siteConfigService);

        $this->assertEquals($siteConfigService, $trait->getSiteConfigService());
    }
}
