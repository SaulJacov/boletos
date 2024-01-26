<?php
require 'conexion_db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recoger los datos del formulario
    $nombre = $_POST["nombre"];
    $telefono = $_POST["whats"];
    $email = $_POST["email"];
    $empresa = $_POST["empresa"];
    $puesto = $_POST["puesto"];

    $sql = "INSERT INTO participantes (nombre, telefono, email, empresa, puesto) 
            VALUES ('$nombre', '$telefono', '$email', '$empresa', '$puesto')";

    // Ejecuta la consulta de inserción
    if ($conn->query($sql) === TRUE) {
        echo "Datos insertados correctamente.";
    } else {
        echo "Error al insertar datos: " . $conn->error;
    }
    // Consulta para obtener el ID después de la inserción
    $id_query = "SELECT * FROM participantes WHERE email = '$email'";
    $resultado = $conn->query($id_query);

    // Verificar si la consulta fue exitosa
    if ($resultado->num_rows > 0) {
        // Iterar a través de los resultados
        while ($fila = $resultado->fetch_assoc()) {
            // Acceder a los datos específicos
            $folio_db = $fila["folio"];
            $nombre_db = $fila["nombre"];
            $whatsapp_db = $fila["telefono"];
            $email_db = $fila["email"];
            $empresa_db = $fila["empresa"];
            $puesto_db = $fila["puesto"];
        }
    } else {
        echo "No se encontraron registros con ese correo electrónico.";
    }
    $conn->close();
}

$encabezado = 'Tu registro para Karol G';
$mensaje = "Línea 1\r\n te has registrado para ganar un boleto de Karol G\r\nLínea 3";
// Si cualquier línea es más larga de 70 caracteres, se debería usar wordwrap()
$mensaje = wordwrap($mensaje, 70, "\r\n");
mail($email_db, $encabezado, $mensaje);

/*header('Location: mensaje_registro.php');
exit;*/
echo "***************************";
echo "email al que se enviara el correo: $email_db<br>";
?>