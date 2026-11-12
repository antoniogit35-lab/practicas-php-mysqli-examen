<?php
try {
    require __DIR__ . '/../../conexion.php';

    $notaMinima = 5;

    $sql = 'SELECT a.nombre AS alumno, s.nombre AS asignatura, m.anio, m.nota
            FROM matriculas AS m
            JOIN alumnos AS a ON a.dni = m.dni
            JOIN asignaturas AS s ON s.codigo = m.codigo
            WHERE m.nota >= ?
            ORDER BY m.nota DESC';
    $stmt = $db->prepare($sql);
    $stmt->bind_param('d', $notaMinima);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows === 0) {
        echo 'No hay matrículas con esa nota.';
    } else {
        echo '<table><tr><th>Alumno</th><th>Asignatura</th><th>Año</th><th>Nota</th></tr>';
        while ($fila = $resultado->fetch_assoc()) {
            $alumno = htmlspecialchars($fila['alumno'], ENT_QUOTES, 'UTF-8');
            $asignatura = htmlspecialchars($fila['asignatura'], ENT_QUOTES, 'UTF-8');
            $anio = (int) $fila['anio'];
            $nota = (float) $fila['nota'];
            echo "<tr><td>$alumno</td><td>$asignatura</td><td>$anio</td><td>$nota</td></tr>";
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
