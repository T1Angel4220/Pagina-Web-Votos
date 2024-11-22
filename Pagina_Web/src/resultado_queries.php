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
// Función para obtener la cantidad de votos por cada partido político
function obtenerVotosPorPartido() {
    global $connection;

    // Consulta SQL para contar los votos por partido
    $sql = "SELECT ID_PAR_VOT, COUNT(*) AS cantidad_votos 
            FROM VOTOS 
            GROUP BY ID_PAR_VOT";
    $result = $connection->query($sql);

    $votosPorPartido = [];
    while ($row = $result->fetch_assoc()) {
        $votosPorPartido[$row['ID_PAR_VOT']] = $row['cantidad_votos'];
    }

    return $votosPorPartido;
}
?>