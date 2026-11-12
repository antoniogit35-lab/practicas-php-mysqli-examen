<?php
try {
    require __DIR__ . '/../../conexion.php';

    $anio = 2026;

    $sql = 'SELECT a.nombre AS alumno, s.nombre AS asignatura, m.nota
            FROM matriculas AS m
            JOIN alumnos AS a ON a.dni = m.dni
            JOIN asignaturas AS s ON s.codigo = m.codigo
            WHERE m.anio = ?
            ORDER BY a.nombre, s.nombre';
    $stmt = $db->prepare($sql);
    $stmt->bind_param('i', $anio);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows === 0) {
        echo 'No hay matrículas en ese año.';
    } else {
        echo '<table><tr><th>Alumno</th><th>Asignatura</th><th>Nota</th></tr>';
        while ($fila = $resultado->fetch_assoc()) {
            $alumno = htmlspecialchars($fila['alumno'], ENT_QUOTES, 'UTF-8');
            $asignatura = htmlspecialchars($fila['asignatura'], ENT_QUOTES, 'UTF-8');
            $nota = $fila['nota'] === null ? 'Pendiente' : (float) $fila['nota'];
            echo "<tr><td>$alumno</td><td>$asignatura</td><td>$nota</td></tr>";
        }
        echo '</table>';
    }

    $resultado->free();
    $stmt->close();
    $db->close();
} catch (mysqli_sql_exception $e) {
    error_log($e->getMessage());
    http_response_code(500);
    echo 'No se pudo completar la operación.';
}
