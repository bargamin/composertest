<?php

namespace OVM\Doctrine\Test;

use OVM\Doctrine\Test\With;

class DoctrineTest extends \PHPUnit_Framework_TestCase
{
    public function testGetingEntityManager() {
        $em = (new With\WithDoctrine()) -> getEntityManager();
        $this->assertInstanceOf('Doctrine\ORM\EntityManager', $em);
    }
}