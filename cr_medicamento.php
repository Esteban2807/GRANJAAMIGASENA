<?php
require_once __DIR__ . '/config/seguridad.php';
verificarSesion();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Medicamento</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <header class="header"><?php include './config/header.php' ?></header>
    <main class="container">
        <div class="content-card">
            <div class="card-header">
                <h1 class="card-title"><i class="fas fa-pills"></i> Crear Medicamento</h1>
            </div>
            <div class="card-body">
                <form action="controllers/medicamentos/op_crear.php" method="POST">
                    <div class="form-group">
                        <label for="nombre">Nombre:</label>
                        <input type="text" name="nombre" id="nombre" required>
                    </div>
                    <div class="form-group">
                        <label for="tipo">Tipo:</label>
                        <select name="tipo" id="tipo" required>
                            <option value="">-- Seleccione --</option>
                            <option value="Desinflamatorio">Desinflamatorio</option>
                            <option value="Analgesico">Analgesico</option>
                            <option value="Antifungico">Antifungico</option>
                            <option value="Antibiotico">Antibiotico</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="marca_proveedor">Marca/Proveedor:</label>
                        <input type="text" name="marca_proveedor" id="marca_proveedor" required>
                    </div>
                    <div class="form-group">
                        <label for="stock_actual">Stock:</label>
                        <input type="number" step="0.01" name="stock_actual" id="stock_actual" required>
                    </div>
                    <div class="form-group">
                        <label for="unidad_medida">Unidad:</label>
                        <select name="unidad_medida" id="unidad_medida" required>
                            <option value="">-- Seleccione --</option>
                            <option value="mg">mg</option>
                            <option value="g">g</option>
                            <option value="ml">ml</option>
                            <option value="cm^3">cm^3</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="fecha_vencimiento">Fecha de vencimiento:</label>
                        <input type="date" name="fecha_vencimiento" id="fecha_vencimiento" required>
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn-action"><i class="fas fa-save"></i> Guardar</button>
                        <a href="medicamentos" class="btn-cancel"><i class="fas fa-times"></i> Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </main>
    <footer class="footer"><?php include './config/footer.php' ?></footer>
    <script src="js/tema.js"></script>
    <script src="js/panel_menu.js"></script>
    <script src="js/dropdowns.js"></script>
</body>
</html>
