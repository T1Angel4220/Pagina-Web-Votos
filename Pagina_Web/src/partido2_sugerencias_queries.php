<?php
// Incluir archivo de configuración para la conexión a la base de datos
include('../Config/config.php');

// Función para obtener el nombre del partido político según su ID_PAR
function obtenerNombrePartido($idPartido) {
    global $connection;  // Hacer disponible la variable de conexión en la función

    // Consulta SQL para obtener el nombre del partido político
    $sql = "SELECT NOM_PAR FROM PARTIDOS_POLITICOS WHERE ID_PAR = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("i", $idPartido);  // Vincular el ID del partido como parámetro
    $stmt->execute();
    $result = $stmt->get_result();
    $nombrePartido = $result->fetch_assoc();
    return $nombrePartido['NOM_PAR'];
}

// Verificar si se enviaron los datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $sugerencias = $_POST['sugerencias'];
    $propuestas = $_POST['propuestas'];
    $comentarios = $_POST['comentarios'];
    $id_partido = $_POST['id_partido'];

    // Verificar si el usuario ya existe
    $stmt = $connection->prepare("SELECT ID_USU FROM USUARIOS WHERE EMAIL_USU = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // El usuario ya existe, obtener su ID
        $usuario = $result->fetch_assoc();
        $id_usuario = $usuario['ID_USU'];
    } else {
        // Insertar nuevo usuario
        $stmt = $connection->prepare("INSERT INTO USUARIOS (NOM_USU, EMAIL_USU) VALUES (?, ?)");
        $stmt->bind_param("ss", $nombre, $email);
        if ($stmt->execute()) {
            $id_usuario = $stmt->insert_id; // Obtener ID del nuevo usuario
        } else {
            echo "Error al registrar el usuario: " . $stmt->error;
            exit;
        }
    }

    // Preparar consulta para insertar en la tabla SUGERENCIAS
    $stmt = $connection->prepare("INSERT INTO SUGERENCIAS (ID_USU_PER, SUGERENCIAS_SUG, PROPUESTA_SUG, COMENTARIOS_SUG, ID_PAR_SUG) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("isssi", $id_usuario, $sugerencias, $propuestas, $comentarios, $id_partido);

    if ($stmt->execute()) {
        // Enviar correo haciendo una solicitud a Node.js
        $url = "http://localhost:3001/send-email";  // Cambia a la ruta correcta de tu servidor Node.js

        $data = array(
            'to' => $email,
            'subject' => 'Confirmación de Sugerencia',
            'message' => 'Gracias por enviar tus sugerencias para el candidato.'
        );

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));  // Especificar que estamos enviando JSON
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));  // Usar json_encode para enviar los datos correctamente

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            echo 'Error de cURL: ' . curl_error($ch);
        } else {
            echo "Respuesta del servidor de correos: " . $response;
        }
        curl_close($ch);

        // Mostrar mensaje de éxito y redireccionar
        echo "<script>alert('¡Sugerencias enviadas con éxito!'); window.location.href = 'candidato2.php';</script>";
    } else {
        echo "Error al enviar sugerencias: " . $stmt->error;
    }

    // Cerrar declaración
    $stmt->close();
} else {
    echo "Método no permitido.";
}

$connection->close();
?>
