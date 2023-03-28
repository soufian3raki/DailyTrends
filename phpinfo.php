<?php
// Obtiene la versión de PHP instalada en el servidor
echo '<h1>Versión de PHP: ' . phpversion() . '</h1>';

// Conecta a la base de datos MySQL
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "nombre_de_la_base_de_datos";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica la conexión a la base de datos
if ($conn->connect_error) {
    echo "Conexión fallida: " . $conn->connect_error;
    phpinfo();
}

// Obtiene la versión de MySQL instalada en el servidor
$result = $conn->query("SELECT VERSION()");

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo '<h1>Versión de MySQL: ' . $row["VERSION()"] . '</h1>';
} else {
    echo 'No se pudo obtener la versión de MySQL';
}

// Cierra la conexión a la base de datos
$conn->close();

?>