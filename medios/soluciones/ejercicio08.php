<?php
try {
    require __DIR__ . '/../../conexion.php';

    $nombre = "' OR '1'='1";

    $stmt = $db->prepare('SELECT dni, nombre FROM alumnos WHERE nombre = ?');
    $stmt->bind_param('s', $nombre);
    $stmt->execute();
    $resultado = $stmt->get_result();

    echo 'Buscado: ' . htmlspecialchars($nombre, ENT_QUOTES, 'UTF-8') . '<br>';
    echo 'Coincidencias: ' . $resultado->num_rows;

    $resultado->free();
    $stmt->close();
    $db->close();
} catch (mysqli_sql_exception $e) {
    error_log($e->getMessage());
    http_response_code(500);
    echo 'No se pudo completar la operación.';
}
