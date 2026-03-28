<?php

namespace Test;

use PHPUnit\Framework\TestCase;
use usuarios;

class UsuariosTest extends TestCase
{
    private $usuario;

    protected function setUp(): void
    {
        $this->usuario = new usuarios();
    }

    public function testSetAndGetDocumento()
    {
        $this->usuario->setDocumento('12345678');
        $this->assertEquals('12345678', $this->usuario->getDocumento());
    }

    public function testSetAndGetNombres()
    {
        $this->usuario->setNombres('Juan');
        $this->assertEquals('Juan', $this->usuario->getNombres());
    }

    public function testSetAndGetApellidos()
    {
        $this->usuario->setApellidos('Perez');
        $this->assertEquals('Perez', $this->usuario->getApellidos());
    }

    public function testConstructor()
    {
        $usuario = new usuarios('CC', '87654321', 'juan@example.com', 'Juan', 'Perez', 'password123', 1);
        $this->assertEquals('CC', $usuario->getTipoDocumento());
        $this->assertEquals('87654321', $usuario->getDocumento());
        $this->assertEquals('juan@example.com', $usuario->getCorreo());
        $this->assertEquals('Juan', $usuario->getNombres());
        $this->assertEquals('Perez', $usuario->getApellidos());
        $this->assertEquals('password123', $usuario->getContrasena());
        $this->assertEquals(1, $usuario->getIdCargo());
    }
}
