<?php
try {
    require __DIR__ . '/../../conexion.php';
    require __DIR__ . '/../preparar.php';
    prepararEscenario($db, 'matricula');

    $dni = '77777777A';
    $codigo = 1;
    $anio = 2026;
    $nuevaNota = 8.25;

    $stmt = $db->prepare(
        'UPDATE matriculas SET nota = ? WHERE dni = ? AND codigo = ? AND anio = ?'
    );
    $stmt->bind_param('dsii', $nuevaNota, $dni, $codigo, $anio);
    $stmt->execute();

    if ($stmt->affected_rows === 1) {
        echo 'Nota actualizada: 1 fila modificada';
    } else {
        echo 'Ninguna fila modificada';
    }

    $stmt->close();
    $db->close();
} catch (mysqli_sql_exception $e) {
    error_log($e->getMessage());
    http_response_code(500);
    echo 'No se pudo completar la operación.';
}
