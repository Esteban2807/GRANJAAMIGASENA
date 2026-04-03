<?php
return [
    'use_smtp' => true,
    'smtp' => [
        'host' => 'smtp.gmail.com',    // <-- Cambia aquí tu servidor SMTP
        'port' => 587,                  // <-- 587 (TLS) o 465 (SSL)
        'username' => 'valeriaromangarcia941@gmail.com',               // <-- Tu correo saliente (ej: tu_correo@gmail.com)
        'password' => 'fjjr hvgs ufec farl',               // <-- Clave de aplicación del proveedor (ej: Gmail App Password)
        'secure' => 'tls',              // <-- 'tls' o 'ssl' según tu proveedor
        'from_email' => 'valeriaromangarcia941@gmail.com',             // <-- Mismo correo que username, normalmente
        'from_name' => 'Granja Amiga',  // <-- Nombre mostrado en el “De:”
    ],
    'reset_base_url' => 'http://localhost:8000',
    // Secreto para firmar el token de restablecimiento (pone aquí un valor fuerte)
    'reset_token_secret' => '', // <-- Define un secreto largo y aleatorio
    // Tiempo de vida del token en segundos (ej: 1800 = 30 minutos)
    'reset_token_ttl' => 1800,
    // Si no usas SMTP, se usará mail() con estos datos de remitente
    'fallback_from' => 'no-reply@localhost',
    'fallback_name' => 'Granja Amiga',
];
