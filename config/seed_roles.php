<?php
require_once __DIR__ . '/seguridad.php';
verificarSesion();
verificarRol([1]);
require_once __DIR__ . '/../class/cargos.php';
$c = new cargos();
$c->seedDefaults();
header('Location: ../l_cargos.php');
exit;
