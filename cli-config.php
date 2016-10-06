<?php

use OVM\Doctrine\Doctrine;
use Doctrine\ORM\Tools\Console\ConsoleRunner;

// autoloader
require getcwd() . DIRECTORY_SEPARATOR . 'lib' . DIRECTORY_SEPARATOR . 'autoload.php';


class WithDoctrine {
    use OVM\Doctrine\Doctrine;
}

$entityManager = (new WithDoctrine()) -> getEntityManager();
return ConsoleRunner::createHelperSet($entityManager);
