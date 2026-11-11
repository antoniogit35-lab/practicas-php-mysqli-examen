<?php
try {
    require __DIR__ . '/../../conexion.php';

    $resultado = $db->query('SELECT nombre, edad FROM alumnos WHERE edad < 19');

    if ($resultado->num_rows === 0) {
        echo 'No hay alumnos con esa condición.';
    } else {
        echo '<table><tr><th>Nombre</th><th>Edad</th></tr>';
        while ($fila = $resultado->fetch_assoc()) {
            $n = htmlspecialchars($fila['nombre'], ENT_QUOTES, 'UTF-8');
            $e = (int) $fila['edad'];
            echo "<tr><td>$n</td><td>$e</td></tr>";
        }
        echo '</table>';
    }

    $resultado->free();
    $db->close();
} catch (mysqli_sql_exception $e) {
    error_log($e->getMessage());
    http_response_code(500);
    echo 'No se pudo completar la operación.';
}
