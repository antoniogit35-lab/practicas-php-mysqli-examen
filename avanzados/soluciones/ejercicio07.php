<?php
try {
    require __DIR__ . '/../../conexion.php';
    require __DIR__ . '/../preparar.php';
    prepararEscenario($db, 'alumno21');

    $dni = '77777777A';
    $nuevaEdad = 21;

    $stmt = $db->prepare('UPDATE alumnos SET edad = ? WHERE dni = ?');
    $stmt->bind_param('is', $nuevaEdad, $dni);
    $stmt->execute();

    if ($stmt->affected_rows === 1) {
        echo 'Edad actualizada: 1 fila modificada';
    } else {
        echo 'Ninguna fila modificada (el alumno no existe o ya tenía ese valor)';
    }

    $stmt->close();
    $db->close();
} catch (mysqli_sql_exception $e) {
    error_log($e->getMessage());
    http_response_code(500);
    echo 'No se pudo completar la operación.';
}
