<?php

namespace OVM\Doctrine\Test;

use OVM\Doctrine\Test\With\With_Doctrine;

class DoctrineTest extends \PHPUnit_Framework_TestCase
{
    public function testGetingEntityManager() {
        $em = (new With_Doctrine()) -> getEntityManager();
        $this->assertInstanceOf('EntityManagerInterface');
    }
}