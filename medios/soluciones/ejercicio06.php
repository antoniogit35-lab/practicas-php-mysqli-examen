<?php
try {
    require __DIR__ . '/../../conexion.php';

    $stmt = $db->prepare('SELECT nombre FROM alumnos WHERE edad = ?');
    $edad = 0;
    $stmt->bind_param('i', $edad);

    foreach ([24, 25] as $edad) {
        $stmt->execute();
        $stmt->bind_result($nombre);
        while ($stmt->fetch() === true) {
            echo htmlspecialchars($nombre, ENT_QUOTES, 'UTF-8') . '<br>';
        }
    }

    $stmt->close();
    $db->close();
} catch (mysqli_sql_exception $e) {
    error_log($e->getMessage());
    http_response_code(500);
    echo 'No se pudo completar la operación.';
}
