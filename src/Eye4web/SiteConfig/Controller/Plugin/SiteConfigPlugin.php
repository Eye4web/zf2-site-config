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

namespace Eye4web\SiteConfig\Controller\Plugin;

use Eye4web\SiteConfig\Service\SiteConfigService;
use Zend\Mvc\Controller\Plugin\AbstractPlugin;

class SiteConfigPlugin extends AbstractPlugin
{
    /**
     * @var SiteConfigService
     */
    private $siteConfigService;

    /**
     * @param SiteConfigService $siteConfigService
     */
    public function __construct(SiteConfigService $siteConfigService)
    {
        $this->siteConfigService = $siteConfigService;
    }

    /**
     * @param string $name
     * @param mixed|null $default
     * @return string
     */
    public function __invoke($name, $default = null)
    {
        return $this->siteConfigService->get($name, $default);
    }
}
