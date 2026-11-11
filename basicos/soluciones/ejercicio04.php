<?php
try {
    require __DIR__ . '/../../conexion.php';

    $resultado = $db->query(
        'SELECT nombre, creditos FROM asignaturas ORDER BY creditos DESC'
    );

    echo 'Total: ' . $resultado->num_rows;
    echo '<table><tr><th>Asignatura</th><th>Créditos</th></tr>';
    while ($fila = $resultado->fetch_assoc()) {
        $n = htmlspecialchars($fila['nombre'], ENT_QUOTES, 'UTF-8');
        $c = (int) $fila['creditos'];
        echo "<tr><td>$n</td><td>$c</td></tr>";
    }
    echo '</table>';

    $resultado->free();
    $db->close();
} catch (mysqli_sql_exception $e) {
    error_log($e->getMessage());
    http_response_code(500);
    echo 'No se pudo completar la operación.';
}
