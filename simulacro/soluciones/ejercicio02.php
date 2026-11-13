<?php
try {
    require __DIR__ . '/../../conexion.php';
    require __DIR__ . '/../preparar.php';
    prepararSimulacro($db);

    $dni = '88888888B';
    $nombre = 'Luis Pérez';
    $edad = 22;
    $codigo = 3;
    $anio = 2026;
    $nota = 6.5;

    $stmt = $db->prepare('INSERT INTO alumnos (dni, nombre, edad) VALUES (?, ?, ?)');
    $stmt->bind_param('ssi', $dni, $nombre, $edad);
    $stmt->execute();
    $mensaje = 'Alumno insertado: ' . $stmt->affected_rows;
    $stmt->close();

    $stmt = $db->prepare(
        'INSERT INTO matriculas (dni, codigo, anio, nota) VALUES (?, ?, ?, ?)'
    );
    $stmt->bind_param('siid', $dni, $codigo, $anio, $nota);
    $stmt->execute();
    $mensaje .= ' — Matrícula insertada: ' . $stmt->affected_rows;
    $stmt->close();

    echo $mensaje;
    $db->close();
} catch (mysqli_sql_exception $e) {
    error_log($e->getMessage());
    http_response_code(500);
    echo 'No se pudo completar el alta.';
}
