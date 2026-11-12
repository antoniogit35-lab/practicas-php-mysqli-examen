<?php
try {
    require __DIR__ . '/../../conexion.php';

    $limite = 22;

    $stmt = $db->prepare(
        'SELECT nombre, edad FROM alumnos WHERE edad < ? ORDER BY edad, nombre'
    );
    $stmt->bind_param('i', $limite);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows === 0) {
        echo 'Sin coincidencias.';
    } else {
        echo 'Coincidencias: ' . $resultado->num_rows;
        echo '<table><tr><th>Nombre</th><th>Edad</th></tr>';
        while ($fila = $resultado->fetch_assoc()) {
            $n = htmlspecialchars($fila['nombre'], ENT_QUOTES, 'UTF-8');
            $e = (int) $fila['edad'];
            echo "<tr><td>$n</td><td>$e</td></tr>";
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
