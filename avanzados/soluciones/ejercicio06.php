<?php
try {
    require __DIR__ . '/../../conexion.php';
    require __DIR__ . '/../preparar.php';
    prepararEscenario($db, 'matricula');

    $dni = '77777777A';
    $codigo = 1;
    $anio = 1999;

    $stmt = $db->prepare(
        'DELETE FROM matriculas WHERE dni = ? AND codigo = ? AND anio = ?'
    );
    $stmt->bind_param('sii', $dni, $codigo, $anio);
    $stmt->execute();

    if ($stmt->affected_rows === 1) {
        echo 'Matrícula eliminada';
    } else {
        echo 'No encontrada';
    }

    $stmt->close();
    $db->close();
} catch (mysqli_sql_exception $e) {
    error_log($e->getMessage());
    http_response_code(500);
    echo 'No se pudo completar la operación.';
}
