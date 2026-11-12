<?php
try {
    require __DIR__ . '/../../conexion.php';

    $limite = 22;

    $stmt = $db->prepare(
        'SELECT dni, nombre FROM alumnos WHERE edad < ? ORDER BY nombre'
    );
    $stmt->bind_param('i', $limite);
    $stmt->execute();
    $stmt->store_result();

    echo 'Total: ' . $stmt->num_rows;
    $stmt->bind_result($dni, $nombre);
    echo '<table><tr><th>DNI</th><th>Nombre</th></tr>';
    while ($stmt->fetch() === true) {
        $d = htmlspecialchars($dni, ENT_QUOTES, 'UTF-8');
        $n = htmlspecialchars($nombre, ENT_QUOTES, 'UTF-8');
        echo "<tr><td>$d</td><td>$n</td></tr>";
    }
    echo '</table>';

    $stmt->free_result();
    $stmt->close();
    $db->close();
} catch (mysqli_sql_exception $e) {
    error_log($e->getMessage());
    http_response_code(500);
    echo 'No se pudo completar la operación.';
}
