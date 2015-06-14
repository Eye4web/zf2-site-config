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

namespace Eye4web\SiteConfig\Options;

use Zend\Stdlib\AbstractOptions;

class ModuleOptions extends AbstractOptions implements ModuleOptionsInterface
{
    /**
     * Change this if you want to use your own entity class
     *
     * @var string
     */
    private $doctrineORMEntityClass = 'Eye4web\SiteConfig\Entity\SiteConfig';

    /**
     * If a config file is set, the 'readerClass' config below is ignored.
     * The reader class will instead be pulled from \Zend\Config\Factory.
     * See the docs folder for information on how to add your own reader.
     *
     * You can specify single file or an array of files
     *
     * @var string
     */
    private $readerClass = 'Eye4web\SiteConfig\Reader\DoctrineORMReader';

    /**
     *  You can use any class implementing either of the two interfaces:
     * \Eye4web\SiteConfig\Reader\ReaderInterface
     * \Zend\Config\Read\ReaderInterface
     *
     * @var null|string|array
     */
    private $configFile = null;

    /**
     * @return string
     */
    public function getDoctrineORMEntityClass()
    {
        return $this->doctrineORMEntityClass;
    }

    /**
     * @param string $doctrineORMEntityClass
     */
    public function setDoctrineORMEntityClass($doctrineORMEntityClass)
    {
        $this->doctrineORMEntityClass = $doctrineORMEntityClass;
    }

    /**
     * @return string
     */
    public function getReaderClass()
    {
        return $this->readerClass;
    }

    /**
     * @param string $readerClass
     */
    public function setReaderClass($readerClass)
    {
        $this->readerClass = $readerClass;
    }

    /**
     * @return array|null|string
     */
    public function getConfigFile()
    {
        return $this->configFile;
    }

    /**
     * @param array|null|string $configFile
     */
    public function setConfigFile($configFile)
    {
        $this->configFile = $configFile;
    }
}
