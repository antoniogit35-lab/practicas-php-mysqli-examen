<?php
try {
    require __DIR__ . '/../../conexion.php';
    require __DIR__ . '/../preparar.php';
    prepararEscenario($db, 'limpio');

    $dni = '77777777A';
    $nombre = 'Ana Martín';
    $edad = 20;

    $stmt = $db->prepare('INSERT INTO alumnos (dni, nombre, edad) VALUES (?, ?, ?)');
    $stmt->bind_param('ssi', $dni, $nombre, $edad);
    $stmt->execute();
    echo 'Insertados: ' . $stmt->affected_rows;

    $stmt->close();
    $db->close();
} catch (mysqli_sql_exception $e) {
    error_log($e->getMessage());
    http_response_code(500);
    echo 'No se pudo completar la operación.';
}
