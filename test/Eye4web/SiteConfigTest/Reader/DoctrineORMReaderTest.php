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
namespace Eye4web\SiteConfigTest\Reader;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityRepository;
use Eye4web\SiteConfig\Entity\SiteConfig;
use Eye4web\SiteConfig\Options\ModuleOptions;
use Eye4web\SiteConfig\Reader\DoctrineORMReader;

class DoctrineORMReaderTest extends \PHPUnit_Framework_TestCase
{
    public function testGetArray()
    {
        $objectManager = $this->getMockBuilder(ObjectManager::class)
            ->setMethods(['getRepository'])
            ->disableOriginalConstructor()
            ->getMock();
        $options = $this->getMockBuilder(ModuleOptions::class)
            ->disableOriginalConstructor()
            ->getMock();
        $repository = $this->getMockBuilder(EntityRepository::class)
            ->setMethods(['findAll'])
            ->disableOriginalConstructor()
            ->getMock();
        $entityClass = "SiteConfigEntityClass";

        $expectedResult = [
            'keyA' => 'valueA',
            'keyB' => 'valueB',
            'keyC' => 'valueC'
        ];

        $dbResult = [];
        foreach ($expectedResult as $key => $value) {
            $entity = new SiteConfig();
            $entity->setKey($key);
            $entity->setValue($value);

            $dbResult[] = $entity;
        }

        $options->expects($this->any())
            ->method('getDoctrineORMEntityClass')
            ->will($this->returnValue($entityClass));

        $objectManager->expects($this->any())
            ->method('getRepository')
            ->with($entityClass)
            ->will($this->returnValue($repository));

        $repository->expects($this->once())
            ->method('findAll')
            ->will($this->returnValue($dbResult));

        $reader = new DoctrineORMReader($objectManager, $options);
        $result = $reader->getArray();
        $this->assertSame($expectedResult, $result);
    }
}
