<?php
try {
    require __DIR__ . '/../../conexion.php';
    require __DIR__ . '/../preparar.php';
    prepararEscenario($db, 'alumno');

    $dni = '77777777A';
    $nombre = 'Ana Martín';
    $edad = 20;

    $stmt = $db->prepare('INSERT INTO alumnos (dni, nombre, edad) VALUES (?, ?, ?)');
    $stmt->bind_param('ssi', $dni, $nombre, $edad);

    try {
        $stmt->execute();
        echo 'Insertados: ' . $stmt->affected_rows;
    } catch (mysqli_sql_exception $e) {
        if ($e->getCode() === 1062) {
            echo 'Ese DNI ya existe.';
        } else {
            throw $e;
        }
    }

    $stmt->close();
    $db->close();
} catch (mysqli_sql_exception $e) {
    error_log($e->getMessage());
    http_response_code(500);
    echo 'No se pudo completar la operación.';
}
