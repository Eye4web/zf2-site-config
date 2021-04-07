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

return [
    'service_manager' => [
        'factories' => [
            \Eye4web\SiteConfig\Config\Config::class                => \Eye4web\SiteConfig\Factory\Config\ConfigFactory::class,
            \Eye4web\SiteConfig\Options\ModuleOptions::class        => \Eye4web\SiteConfig\Factory\Options\ModuleOptionsFactory::class,
            \Eye4web\SiteConfig\Reader\DoctrineORMReader::class     => \Eye4web\SiteConfig\Factory\Reader\DoctrineORMReaderFactory::class,
            \Eye4web\SiteConfig\Service\SiteConfigService::class    => \Eye4web\SiteConfig\Factory\Service\SiteConfigServiceFactory::class,
        ],
        'initializers' => [
            \Eye4web\SiteConfig\Initializer\SiteConfigServiceInitializer::class,
        ],
    ],
    'view_helpers' => [
        'factories' => [
            \Eye4web\SiteConfig\View\Helper\SiteConfigHelper::class => \Eye4web\SiteConfig\Factory\View\Helper\SiteConfigHelperFactory::class,
        ],
        'aliases' => [
            'siteConfig' => \Eye4web\SiteConfig\View\Helper\SiteConfigHelper::class,
        ],
    ],
    'controller_plugins' => [
        'factories' => [
            \Eye4web\SiteConfig\Controller\Plugin\SiteConfigPlugin::class => \Eye4web\SiteConfig\Factory\Controller\Plugin\SiteConfigPluginFactory::class,
        ],
        'aliases' => [
            'siteConfig' => \Eye4web\SiteConfig\Controller\Plugin\SiteConfigPlugin::class,
        ],
    ],
    'doctrine' => [
        'driver' => [
            'eye4web_siteconfig_driver' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\XmlDriver',
                'paths' => __DIR__.'/xml/eye4websiteconfig',
            ),
            'orm_default' => [
                'drivers' => [
                    'Eye4web\SiteConfig' => 'eye4web_siteconfig_driver',
                ],
            ],
        ],
        'migrations_configuration' => [
            'orm_default' => [
                'migrations_paths' => ['Application\Migration' => 'module/Application/src/Application/Migration'],
                'table_storage' => [
                    'table_name' => 'migrations',
                    'version_column_name' => 'version',
                    'version_column_length' => 1024,
                ],
            ],
        ],
    ],
];
