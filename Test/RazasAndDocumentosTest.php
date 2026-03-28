<?php

namespace Test;

use PHPUnit\Framework\TestCase;
use razas;
use Tipos_documento;

class RazasAndDocumentosTest extends TestCase
{
    public function testRazaConstructor()
    {
        $raza = new razas(1, 'Holstein', 1);
        $this->assertEquals(1, $raza->getId());
        $this->assertEquals('Holstein', $raza->getNombre());
        $this->assertEquals(1, $raza->getIdEspecie());
    }

    public function testTipoDocumentoConstructor()
    {
        $doc = new Tipos_documento(1, 'Cedula de Ciudadania', 'CC', 'Activo');
        $this->assertEquals(1, $doc->getId());
        $this->assertEquals('Cedula de Ciudadania', $doc->getNombre());
        $this->assertEquals('CC', $doc->getSiglas());
        $this->assertEquals('Activo', $doc->getEstado());
    }
}
