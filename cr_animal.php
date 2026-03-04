<?php
include_once 'class/especies.php';
$especies = new Especies();
$especiesData = $especies->listar();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Animal</title>
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
                    <i class="fas fa-user-plus"></i> Crear Animal
                </h1>
            </div>

            <div class="card-body">
                <form action="controllers/animales/op_crear.php" method="POST">
                    <div class="form-group">
                        <label for="nombre">Nombre:</label>
                        <input type="text" name="nombre" id="nombre" placeholder="Ingrese Nombre" required>
                    </div>
                    <div class="form-group">
                        <label for="especie">Especie:</label>
                        <select name="id_especie" id="id_especie" required>
                            <option value="">-- Seleccione --</option>
                            <?php foreach ($especiesData as $item): ?>
                                <option value="<?= htmlspecialchars($item['id']) ?>">
                                    <?= htmlspecialchars($item['nombre']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="raza">Raza:</label>
                        <select name="id_raza" id="id_raza" required>
                            <option value="">-- Seleccione --</option>
                            <?php foreach ($razasData as $item): ?>
                                <option value="<?= htmlspecialchars($item['id']) ?>">
                                    <?= htmlspecialchars($item['nombre']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="padre">Padre:</label>
                        <select name="id_padre" id="id_padre">
                            <option value="">-- Seleccione --</option>
                            <?php foreach ($animalesData as $item): ?>
                                <option value="<?= htmlspecialchars($item['id']) ?>">
                                    <?= htmlspecialchars($item['nombre']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="madre">Madre:</label>
                        <select name="id_madre" id="id_madre">
                            <option value="">-- Seleccione --</option>
                            <?php foreach ($animalesData as $item): ?>
                                <option value="<?= htmlspecialchars($item['id']) ?>">
                                    <?= htmlspecialchars($item['nombre']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="observaciones">Observaciones:</label>
                        <textarea name="observaciones" id="observaciones" placeholder="Ingrese Observaciones"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
                        <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" required>
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn-action">
                            <i class="fas fa-save"></i> Guardar
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
