<?php
// Router para php -S localhost:8000 router.php
$uri = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

// Servir archivos estáticos directamente
if (preg_match('/\.(css|js|png|jpg|jpeg|gif|ico|svg|woff|woff2|ttf|eot|map|html|pdf)$/', $uri)) {
    return false;
}

// Si el archivo PHP existe físicamente en el disco, servirlo directo
$file = __DIR__ . $uri;
if ($uri !== '/' && file_exists($file) && !is_dir($file)) {
    return false;
}

// Mapeo de rutas amigables a archivos PHP
$routes = [
    '/'                                   => 'login.php',
    '/login'                              => 'login.php',
    '/inicio'                             => 'index.php',
    '/logout'                             => 'logout.php',
    '/forgot_password'                    => 'forgot_password.php',
    '/reset_password'                     => 'reset_password.php',

    // Rutas de config (POST desde formularios)
    '/config/login.php'                   => 'config/login.php',
    '/config/register.php'                => 'config/register.php',

    '/tipos-documento'                    => 'l_tipos_documento.php',
    '/tipos-documento/nuevo'              => 'cr_tipos_documento.php',
    '/tipos-documento/actualizar'         => 'ac_tipos_documento.php',

    '/animales'                           => 'l_animales.php',
    '/animales/nuevo'                     => 'cr_animal.php',
    '/animales/actualizar'                => 'ac_animal.php',

    '/especies'                           => 'l_especies.php',
    '/especies/nuevo'                     => 'cr_especie.php',
    '/especies/actualizar'                => 'ac_especie.php',

    '/razas'                              => 'l_razas.php',
    '/razas/nuevo'                        => 'cr_raza.php',
    '/razas/actualizar'                   => 'ac_raza.php',

    '/cargos'                             => 'l_cargos.php',
    '/cargos/nuevo'                       => 'cr_cargo.php',
    '/cargos/actualizar'                  => 'ac_cargo.php',

    '/usuarios'                           => 'l_usuarios.php',
    '/usuarios/nuevo'                     => 'cr_usuario.php',
    '/usuarios/actualizar'                => 'ac_usuario.php',

    '/alimentos'                          => 'l_alimentos.php',
    '/alimentos/nuevo'                    => 'cr_alimento.php',
    '/alimentos/actualizar'               => 'ac_alimento.php',

    '/medicamentos'                       => 'l_medicamentos.php',
    '/medicamentos/nuevo'                 => 'cr_medicamento.php',
    '/medicamentos/actualizar'            => 'ac_medicamento.php',

    '/vacunas'                            => 'l_vacunas.php',
    '/vacunas/nuevo'                      => 'cr_vacuna.php',
    '/vacunas/actualizar'                 => 'ac_vacuna.php',

    '/alimentaciones'                     => 'l_alimentaciones.php',
    '/alimentaciones/nuevo'               => 'cr_alimentacion.php',
    '/alimentaciones/actualizar'          => 'ac_alimentacion.php',

    '/medicaciones'                       => 'l_medicaciones.php',
    '/medicaciones/nuevo'                 => 'cr_medicacion.php',
    '/medicaciones/actualizar'            => 'ac_medicacion.php',

    '/vacunaciones'                       => 'l_vacunaciones.php',
    '/vacunaciones/nuevo'                 => 'cr_vacunacion.php',
    '/vacunaciones/actualizar'            => 'ac_vacunacion.php',

    '/partos'                             => 'l_partos.php',
    '/partos/nuevo'                       => 'cr_parto.php',
    '/partos/actualizar'                  => 'ac_parto.php',

    '/nacimientos'                        => 'l_nacimientos.php',
    '/nacimientos/nuevo'                  => 'cr_nacimiento.php',
    '/nacimientos/actualizar'             => 'ac_nacimiento.php',

    '/atenciones-veterinarias'            => 'l_atenciones_veterinarias.php',
    '/atenciones-veterinarias/nuevo'      => 'cr_atencion_veterinaria.php',
    '/atenciones-veterinarias/actualizar' => 'ac_atencion_veterinaria.php',
];

$path = strtok($uri, '?');

if (isset($routes[$path])) {
    require __DIR__ . '/' . $routes[$path];
} else {
    http_response_code(404);
    echo "<h1>404 - Página no encontrada</h1><p>Ruta: $path</p><a href='/login'>Volver al login</a>";
}