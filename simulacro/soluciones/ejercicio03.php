<?php
try {
    require __DIR__ . '/../../conexion.php';

    $nombre = $_GET['nombre'] ?? '';
    if (!is_string($nombre)) {
        http_response_code(400);
        exit('Nombre no válido.');
    }

    /*
      Por qué no debe concatenarse el valor:
      al escribir el nombre dentro de la cadena SQL, el usuario puede meter
      comillas y trozos de SQL que cambian la consulta (inyección SQL). Con
      una sentencia preparada, la plantilla y el valor viajan por separado y
      el nombre se trata siempre como un dato, nunca como código.
    */
    $stmt = $db->prepare('SELECT dni, nombre FROM alumnos WHERE nombre = ?');
    $stmt->bind_param('s', $nombre);
    $stmt->execute();
    $r = $stmt->get_result();

    echo 'Coincidencias: ' . $r->num_rows;
    if ($r->num_rows > 0) {
        echo '<table><tr><th>DNI</th><th>Nombre</th></tr>';
        while ($fila = $r->fetch_assoc()) {
            $d = htmlspecialchars($fila['dni'], ENT_QUOTES, 'UTF-8');
            $n = htmlspecialchars($fila['nombre'], ENT_QUOTES, 'UTF-8');
            echo "<tr><td>$d</td><td>$n</td></tr>";
        }
        echo '</table>';
    }

    $r->free();
    $stmt->close();
    $db->close();
} catch (mysqli_sql_exception $e) {
    error_log($e->getMessage());
    http_response_code(500);
    echo 'No se pudo completar la operación.';
}
