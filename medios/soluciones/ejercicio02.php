<?php
try {
    require __DIR__ . '/../../conexion.php';

    $edad1 = 21;
    $edad2 = 24;

    $stmt = $db->prepare(
        'SELECT nombre, edad FROM alumnos WHERE edad = ? OR edad = ? ORDER BY edad'
    );
    $stmt->bind_param('ii', $edad1, $edad2);
    $stmt->execute();
    $resultado = $stmt->get_result();

    echo '<table><tr><th>Nombre</th><th>Edad</th></tr>';
    while ($fila = $resultado->fetch_assoc()) {
        $n = htmlspecialchars($fila['nombre'], ENT_QUOTES, 'UTF-8');
        $e = (int) $fila['edad'];
        echo "<tr><td>$n</td><td>$e</td></tr>";
    }
    echo '</table>';

    $resultado->free();
    $stmt->close();
    $db->close();
} catch (mysqli_sql_exception $e) {
    error_log($e->getMessage());
    http_response_code(500);
    echo 'No se pudo completar la operación.';
}
