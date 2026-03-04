<?php
/* ---- Carga de datos y registro actual ---- */
/* Leer registro a editar */
include_once 'class/tipos_documento.php';
$tipos_documento = new Tipos_documento();
$tipos_documento->setId($_POST['id']);
$tipos_documento->consultar();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Tipo de Documento</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

    <!-- Header -->
    <header class="header"><?php include './config/header.php'?></header>

    <!-- Main Content -->
    <main class="container">
        <div class="content-card">
            <div class="card-header">
                <h1 class="card-title">
                    <i class="fas fa-id-card"></i> Actualizar Tipo de Documento
                </h1>
            </div>

            <div class="card-body">
                <form action="controllers/tipos_documento/op_actualizar.php" method="post">
                    <input type="hidden" name="id" value="<?= htmlspecialchars($tipos_documento->getId()) ?>">

                    <div class="form-group">
                        <label for="nombre">Nombre:</label>
                        <input type="text" name="nombre" id="nombre" placeholder="Ingrese Nombre" value="<?= htmlspecialchars($tipos_documento->getNombre()) ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="siglas">Siglas:</label>
                        <input type="text" name="siglas" id="siglas" placeholder="Ingrese Siglas" value="<?= htmlspecialchars($tipos_documento->getSiglas()) ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="estado">Estado:</label>
                        <select name="estado" id="estado">
                            <option value="1" <?= $tipos_documento->getEstado() == '1' ? 'selected' : '' ?>>Activo</option>
                            <option value="0" <?= $tipos_documento->getEstado() == '0' ? 'selected' : '' ?>>Inactivo</option>
                        </select>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn-action">
                            <i class="fas fa-save"></i> Guardar Cambios
                        </button>
                        <a href="l_tipos_documento.php" class="btn-cancel">
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