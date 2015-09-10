<?php

namespace LaravelDoctrine\ORM\Extensions;

use Doctrine\Common\Persistence\Mapping\Driver\MappingDriver;
use Doctrine\Common\Persistence\Mapping\Driver\MappingDriverChain as DoctrineMappingDriverChain;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;

class MappingDriverChain extends DoctrineMappingDriverChain implements MappingDriver
{
    /**
     * @param MappingDriver $driver
     * @param               $namespace
     */
    public function __construct(MappingDriver $driver, $namespace)
    {
        $this->addDriver($driver, $namespace);
        $this->setDefaultDriver($driver);
    }

    /**
     * @param $namespace
     */
    public function addNamespace($namespace)
    {
        $this->addDriver($this->getDefaultDriver(), $namespace);
    }

    /**
     * @return \Doctrine\Common\Annotations\Reader|null
     */
    public function getReader()
    {
        $driver = $this->getDefaultDriver();

        if ($driver instanceof AnnotationDriver) {
            return $driver->getReader();
        }
    }
}
