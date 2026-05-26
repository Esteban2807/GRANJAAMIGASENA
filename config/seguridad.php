<?php
session_start();

function verificarRol($rolesPermitidos) {
    if (!isset($_SESSION['rol_id'])) {
        header("Location: /login.php");
        exit();
    }
    if (!in_array($_SESSION['rol_id'], $rolesPermitidos)) {
        header("Location: /inicio.php");
        exit();
    }
}

function verificarSesion() {
    if (!isset($_SESSION['user'])) {
        header("Location: /login.php");
        exit;
    }
}