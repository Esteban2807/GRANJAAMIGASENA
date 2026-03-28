<?php

namespace Test;

use PHPUnit\Framework\TestCase;
use animales;

class AnimalesTest extends TestCase
{
    private $animal;

    protected function setUp(): void
    {
        $this->animal = new animales();
    }

    public function testSetAndGetId()
    {
        $this->animal->setId('A001');
        $this->assertEquals('A001', $this->animal->getId());
    }

    public function testSetAndGetNombre()
    {
        $this->animal->setNombre('Vaca Lola');
        $this->assertEquals('Vaca Lola', $this->animal->getNombre());
    }

    public function testSetAndGetFechaNacimiento()
    {
        $fecha = '2025-01-01';
        $this->animal->setFechaNacimiento($fecha);
        $this->assertEquals($fecha, $this->animal->getFechaNacimiento());
    }

    public function testConstructor()
    {
        $animal = new animales('2025-01-01', 'Vaca Lola', 'A001', 1, 1, 'P001', 'M001', 'Ninguna');
        $this->assertEquals('2025-01-01', $animal->getFechaNacimiento());
        $this->assertEquals('Vaca Lola', $animal->getNombre());
        $this->assertEquals('A001', $animal->getId());
        $this->assertEquals(1, $animal->getIdEspecie());
        $this->assertEquals(1, $animal->getIdRaza());
        $this->assertEquals('P001', $animal->getIdPadre());
        $this->assertEquals('M001', $animal->getIdMadre());
        $this->assertEquals('Ninguna', $animal->getObservaciones());
    }
}
