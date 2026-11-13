<?php
try {
    require __DIR__ . '/../../conexion.php';

    $dni = '44444444R';

    $sql = 'SELECT a.nombre AS alumno, s.nombre AS asignatura, m.anio, m.nota
            FROM alumnos AS a
            LEFT JOIN matriculas AS m ON m.dni = a.dni
            LEFT JOIN asignaturas AS s ON s.codigo = m.codigo
            WHERE a.dni = ?
            ORDER BY m.anio DESC, s.nombre';
    $stmt = $db->prepare($sql);
    $stmt->bind_param('s', $dni);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows === 0) {
        echo 'Alumno no encontrado.';
    } else {
        $filas = $resultado->fetch_all(MYSQLI_ASSOC);
        $alumno = htmlspecialchars($filas[0]['alumno'], ENT_QUOTES, 'UTF-8');
        echo 'Alumno: ' . $alumno;

        if ($filas[0]['anio'] === null) {
            echo ' — Sin matrículas';
        } else {
            echo '<table><tr><th>Asignatura</th><th>Año</th><th>Nota</th></tr>';
            foreach ($filas as $fila) {
                $asignatura = htmlspecialchars($fila['asignatura'], ENT_QUOTES, 'UTF-8');
                $anio = (int) $fila['anio'];
                $nota = $fila['nota'] === null ? 'Pendiente' : (float) $fila['nota'];
                echo "<tr><td>$asignatura</td><td>$anio</td><td>$nota</td></tr>";
            }
            echo '</table>';
        }
    }

    $resultado->free();
    $stmt->close();
    $db->close();
} catch (mysqli_sql_exception $e) {
    error_log($e->getMessage());
    http_response_code(500);
    echo 'No se pudo completar la operación.';
}
