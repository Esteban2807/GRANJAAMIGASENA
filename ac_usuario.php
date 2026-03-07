<?php
require_once __DIR__ . '/config/seguridad.php';
verificarSesion();
include_once 'class/tipos_documento.php';
$tipos_documento = new Tipos_documento();
$tipos_documentoData = $tipos_documento->listar();

include_once 'class/usuarios.php';
$usuario = new usuarios();
$usuario->setDocumento($_POST['documento']);
$usuario->consultar();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Usuario</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>

    <!-- Header -->
    <header class="header"><?php include './config/header.php' ?></header>

    <!-- Main Content -->
    <main class="container">
        <div class="content-card">
            <div class="card-header">
                <h1 class="card-title">
                    <i class="fas fa-user-circle"></i> Actualizar Usuario
                </h1>
            </div>

            <div class="card-body">
                <form action="controllers/usuarios/op_actualizar.php" method="post">
                    <input type="hidden" name="documento" value="<?= htmlspecialchars($usuario->getDocumento()) ?>">

                    <div class="form-group">
                        <label for="tipo_documento">Tipo de documento:</label>
                        <select name="tipo_documento" id="tipo_documento" required>
                            <option value="">-- Seleccione --</option>
                            <?php foreach ($tipos_documentoData as $item): ?>
                                <option value="<?= htmlspecialchars($item['nombre']) ?>" <?= $usuario->getTipoDocumento() == $item['nombre'] ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($item['nombre']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="nombres">Nombres:</label>
                        <input type="text" name="nombres" id="nombres" placeholder="Ingrese Nombres" value="<?= htmlspecialchars($usuario->getNombres()) ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="apellidos">Apellidos:</label>
                        <input type="text" name="apellidos" id="apellidos" placeholder="Ingrese Apellidos" value="<?= htmlspecialchars($usuario->getApellidos()) ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="correo">Correo:</label>
                        <input type="email" name="correo" id="correo" placeholder="Ingrese Correo" value="<?= htmlspecialchars($usuario->getCorreo()) ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="contrasena">Contraseña:</label>
                        <input type="password" name="contrasena" id="contrasena" placeholder="Ingrese Contraseña" value="<?= htmlspecialchars($usuario->getContrasena()) ?>" required>
                    </div>

                    <?php if (isset($_SESSION['rol_id']) && $_SESSION['rol_id'] == 1): ?>
                        <?php 
                            include_once 'class/cargos.php'; 
                            $roles = (new cargos())->listar(); 
                        ?>
                        <div class="form-group">
                            <label for="id_cargo">Rol:</label>
                            <select name="id_cargo" id="id_cargo">
                                <?php foreach ($roles as $r): ?>
                                    <option value="<?= htmlspecialchars($r['id']) ?>" <?= $usuario->getIdCargo() == $r['id'] ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($r['id'] . ' - ' . $r['nombre']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    <?php else: ?>
                        <input type="hidden" name="id_cargo" value="<?= htmlspecialchars($usuario->getIdCargo()) ?>">
                    <?php endif; ?>

                    <div class="form-actions">
                        <button type="submit" class="btn-action">
                            <i class="fas fa-save"></i> Guardar Cambios
                        </button>
                        <a href="l_usuarios.php" class="btn-cancel">
                            <i class="fas fa-times"></i> Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="footer"><?php include './config/footer.php' ?></footer>
    <!-- Scripts -->
    <script src="js/tema.js"></script>
    <script src="js/panel_menu.js"></script>
    <script src="js/dropdowns.js"></script>

</body>

</html>
