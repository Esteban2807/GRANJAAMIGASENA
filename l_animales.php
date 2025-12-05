<?php
include_once 'class/c_animales.php';

$animal = new animales();

$lista = $animal->listar();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/reset.css">
  <title>Animales</title>
</head>

<body class="bodyConsultarAnimal">
  <header>
    <nav>
      <a href="index.html"><svg xmlns="http://www.w3.org/2000/svg" height="24" width="27"
          viewBox="0 0 576 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
          <path fill="#56b857"
            d="M575.8 255.5c0 18-15 32.1-32 32.1l-32 0 .7 160.2c0 2.7-.2 5.4-.5 8.1l0 16.2c0 22.1-17.9 40-40 40l-16 0c-1.1 0-2.2 0-3.3-.1c-1.4 .1-2.8 .1-4.2 .1L416 512l-24 0c-22.1 0-40-17.9-40-40l0-24 0-64c0-17.7-14.3-32-32-32l-64 0c-17.7 0-32 14.3-32 32l0 64 0 24c0 22.1-17.9 40-40 40l-24 0-31.9 0c-1.5 0-3-.1-4.5-.2c-1.2 .1-2.4 .2-3.6 .2l-16 0c-22.1 0-40-17.9-40-40l0-112c0-.9 0-1.9 .1-2.8l0-69.7-32 0c-18 0-32-14-32-32.1c0-9 3-17 10-24L266.4 8c7-7 15-8 22-8s15 2 21 7L564.8 231.5c8 7 12 15 11 24z" />
        </svg></a>
      <a href="agregarAnimal.html">Agregar animal</a>
      <a href="agregarRecordatorio.html">Recordatorio de vacuna</a>
      <a href="registrarVacuna.html">Registrar vacunación</a>
      <a href="registrarPreparto.html">Registrar preparto</a>
    </nav>
    <img src="img/logo.png" alt="logo sena">
    <p>SERVICIO NACIONAL DE APRENDIZAJE </p>
  </header>
  <h1>Lista de animales</h1>
  <main>
    <table>
      <thead>
        <tr>
          <th>N° de chapeta</th>
          <th>Nombre</th>
          <th>Especie</th>
          <th>Raza</th>
          <th>F. de nacimiento</th>
          <th>Observaciones</th>
          <th colspan="2">Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php
        foreach ($lista as $resultado) {
        ?>
          <tr>
            <td><?= $resultado['id'] ?></td>
            <td><?= $resultado['nombre'] ?></td>
            <td><?= $resultado['especie'] ?></td>
            <td><?= $resultado['raza'] ?></td>
            <td><?= $resultado['fecha_de_nacimiento'] ?></td>
            <td><?= $resultado['observaciones'] ?></td>
            <td style="width: 20px;">
              <button onclick="eliminar(<?= $resultado['id']; ?>,'animales')">Eliminar</button>
            </td>
            <td style="width: 20px;">
              <button onclick="actualizar(<?= $resultado['id']; ?>,'animales')">Actualizar</button>
            </td>
          </tr>
        <?php
        }
        ?>
      </tbody>
    </table>
  </main>
  <script src="js/script.js"></script>
  <script src="js/sweetalert2.all.min.js"></script>
  <script src="js/fontawesome.all.min.js"></script>
</body>

</html>