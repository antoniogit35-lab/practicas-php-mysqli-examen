<?php
try {
    require __DIR__ . '/../../conexion.php';

    $texto = 'lo';
    $patron = '%' . $texto . '%';

    $stmt = $db->prepare(
        'SELECT nombre, edad FROM alumnos WHERE nombre LIKE ? ORDER BY nombre'
    );
    $stmt->bind_param('s', $patron);
    $stmt->execute();
    $stmt->bind_result($nombre, $edad);

    $total = 0;
    $filas = '';
    while ($stmt->fetch() === true) {
        $total++;
        $n = htmlspecialchars($nombre, ENT_QUOTES, 'UTF-8');
        $e = (int) $edad;
        $filas .= "<tr><td>$n</td><td>$e</td></tr>";
    }

    if ($total === 0) {
        echo 'No hay alumnos que coincidan.';
    } else {
        echo 'Coincidencias: ' . $total;
        echo '<table><tr><th>Nombre</th><th>Edad</th></tr>' . $filas . '</table>';
    }

    $stmt->close();
    $db->close();
} catch (mysqli_sql_exception $e) {
    error_log($e->getMessage());
    http_response_code(500);
    echo 'No se pudo completar la operación.';
}
