<?php
    include_once '../class/c_animales.php';
        $animal = new animales();
        $animal->setId($_POST['id']);
        $animal->eliminar();
        header("Location: ../l_animales.php");
    
?>