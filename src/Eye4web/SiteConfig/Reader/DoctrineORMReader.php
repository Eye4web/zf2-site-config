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

namespace Eye4web\SiteConfig\Reader;

use Doctrine\Common\Persistence\ObjectManager;
use Eye4web\SiteConfig\Options\ModuleOptionsInterface;

class DoctrineORMReader implements ReaderInterface
{
    /**
     * @var ObjectManager
     */
    private $objectManager;

    /**
     * @var ModuleOptionsInterface
     */
    private $options;

    /**
     * @param ObjectManager          $objectManager
     * @param ModuleOptionsInterface $options
     */
    public function __construct(ObjectManager $objectManager, ModuleOptionsInterface $options)
    {
        $this->objectManager = $objectManager;
        $this->options = $options;
    }

    /**
     * @return array
     */
    public function getArray()
    {
        $entityClass = $this->options->getDoctrineORMEntityClass();
        $dbConfigs = $this->objectManager->getRepository($entityClass)->findAll();

        $configs = [];
        /** @var \Eye4web\SiteConfig\Entity\SiteConfig $config */
        foreach ($dbConfigs as $config) {
            $configs[$config->getKey()] = $config->getValue();
        }

        return $configs;
    }
}
