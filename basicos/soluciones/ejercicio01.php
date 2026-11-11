<?php
try {
    require __DIR__ . '/../../conexion.php';
    echo 'Conexión correcta';
    $db->close();
} catch (mysqli_sql_exception $e) {
    error_log($e->getMessage());
    http_response_code(500);
    echo 'No se pudo conectar con la base de datos.';
}
