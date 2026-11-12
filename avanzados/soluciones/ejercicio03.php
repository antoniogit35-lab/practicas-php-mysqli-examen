<?php
try {
    require __DIR__ . '/../../conexion.php';
    require __DIR__ . '/../preparar.php';
    prepararEscenario($db, 'alumno');

    $dni = '77777777A';
    $codigo = 1;
    $anio = 2026;
    $nota = 7.5;

    $stmt = $db->prepare(
        'INSERT INTO matriculas (dni, codigo, anio, nota) VALUES (?, ?, ?, ?)'
    );
    $stmt->bind_param('siid', $dni, $codigo, $anio, $nota);
    $stmt->execute();
    echo 'Insertadas: ' . $stmt->affected_rows;

    $stmt->close();
    $db->close();
} catch (mysqli_sql_exception $e) {
    error_log($e->getMessage());
    http_response_code(500);
    echo 'No se pudo completar la operación.';
}
