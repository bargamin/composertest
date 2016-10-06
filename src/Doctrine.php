<?php

namespace OVM\Doctrine;

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use Sylphid\Config;

trait Doctrine
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    static private $entityManager = FALSE;


    /**
     * Gets Entity Manager from doctrine
     *
     * @return \Doctrine\ORM\EntityManager
     */
    public function getEntityManager() {
        if (!self::$entityManager) {
            $paths = array("src/Entity");
            $config = new Config\Map('conf');
            $dbParams = array(
                'driver'            => $config->doctrine->driver,
                'user'              => $config->doctrine->user,
                'password'          => $config->doctrine->password,
                'dbname'            => $config->doctrine->dbname,
                'host'              => $config->doctrine->host,
                'port'              => $config->doctrine->port,
                'charset'           => $config->doctrine->charset,
                'application_name'  => $config->doctrine->application_name
            );

            $configMetadata = Setup::createAnnotationMetadataConfiguration($paths, TRUE);
            self::$entityManager = EntityManager::create($dbParams, $configMetadata);
        }

        return self::$entityManager;
    }
}
