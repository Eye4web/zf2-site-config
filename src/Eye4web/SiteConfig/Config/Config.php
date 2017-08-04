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

namespace Eye4web\SiteConfig\Config;

use Dflydev\DotAccessData\Data;
use Zend\Config\Config as ZendConfig;

class Config extends ZendConfig implements ConfigInterface
{
    protected $data;
    protected $dotData;

    /**
     * Config constructor.
     *
     * @param array $array
     */
    public function __construct(array $array, $allowModifications = false)
    {
        parent::__construct($array, $allowModifications);
        $this->dotData = new Data($array);
    }

    /**
     * @param string $name
     * @param null   $default
     *
     * @return null
     */
    public function get($name, $default = null)
    {
        if (strpos($name, '.')) {
            if (!$this->dotData->has($name)) {
                return $default;
            }
            return $this->dotData->get($name);
        }

        return parent::get($name, $default);
    }

    /**
     * @param string $name
     * @param mixed  $value
     *
     * @return void
     */
    public function set($name, $value)
    {
        if (strpos($name, '.')) {
            $this->dotData->set($name, $value);
            return;
        }

        parent::set($name, $value);
    }
}
