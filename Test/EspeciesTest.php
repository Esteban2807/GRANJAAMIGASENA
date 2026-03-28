<?php

namespace Test;

use PHPUnit\Framework\TestCase;
use especies;

class EspeciesTest extends TestCase
{
    private $especie;

    protected function setUp(): void
    {
        $this->especie = new especies();
    }

    public function testSetAndGetId()
    {
        $this->especie->setId(1);
        $this->assertEquals(1, $this->especie->getId());
    }

    public function testSetAndGetNombre()
    {
        $this->especie->setNombre('Bovino');
        $this->assertEquals('Bovino', $this->especie->getNombre());
    }

    public function testConstructor()
    {
        $especie = new especies(2, 'Equino');
        $this->assertEquals(2, $especie->getId());
        $this->assertEquals('Equino', $especie->getNombre());
    }
}
