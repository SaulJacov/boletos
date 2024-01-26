<?php
$servername = "localhost";
$username = "solucomx_boletos";
$password = "boletosKG";
$dbname = "solucomx_boletos2024";
$conn = new mysqli($servername, $username, $password, $dbname);
// Verificar la conexion
if ($conn->connect_error) {
    die("Error de conexion: " . $conn->connect_error);
}
?>