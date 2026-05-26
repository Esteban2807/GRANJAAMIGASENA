<?php

// Datos de conexión
$host = "localhost";
$usuario = "root";
$contrasena = "";
$base_datos = "granjaamiga";

// Crear conexión
$conn = new mysqli($host, $usuario, $contrasena, $base_datos);

// Verificar conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

echo "Conexión exitosa<br>";

// ===============================
// ESCRIBÍ TU CONSULTA ACÁ
// ===============================
$contrasena = md5("Calamardo1620");
$sql = "UPDATE usuarios SET contrasena = '$contrasena' WHERE documento = '1054864249'";

// Ejecutar consulta
$resultado = $conn->query($sql);

// Verificar si devolvió resultados
if ($resultado) {

    // Si es un SELECT
    if ($resultado instanceof mysqli_result) {

        if ($resultado->num_rows > 0) {

            while($fila = $resultado->fetch_assoc()) {
                echo "<pre>";
                print_r($fila);
                echo "</pre>";
            }

        } else {
            echo "Sin resultados";
        }

    } else {
        // Para INSERT, UPDATE, DELETE
        echo "Consulta ejecutada correctamente";
    }

} else {
    echo "Error en la consulta: " . $conn->error;
}

// Cerrar conexión
$conn->close();

?>