<?php
/*
  EJERCICIO 3: CORREGIR CÓDIGO INSEGURO

  ENUNCIADO:
  Reescribe el siguiente fragmento utilizando una sentencia preparada.
  Además, escapa el nombre antes de mostrarlo.
  Explica en un comentario por qué no debe concatenarse el valor.

  FRAGMENTO ORIGINAL (no lo ejecutes):
      $nombre = $_GET['nombre'] ?? '';
      $sql = "SELECT dni, nombre FROM alumnos WHERE nombre = '$nombre'";
      $r = $db->query($sql);

  Sin consultar los ejercicios anteriores.
*/

try {
    require __DIR__ . '/../../conexion.php';

    $nombre = $_GET['nombre'] ?? '';

    // Tu solución

} catch (mysqli_sql_exception $e) {
    error_log($e->getMessage());
    http_response_code(500);
    echo 'No se pudo completar la operación.';
}
