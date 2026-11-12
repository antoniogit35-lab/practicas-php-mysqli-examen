<?php
/*
  EJERCICIO 7: ACTUALIZAR SIN CAMBIAR NADA

  ENUNCIADO:
  El alumno 77777777A ya tiene 21 años. Actualiza su edad a 21 y explica
  el resultado según affected_rows.

  OBJETIVO:
  Entiende qué cuenta affected_rows en un UPDATE.

  PISTA:
  Consulta analisis.md si necesitas orientación.
*/

try {
    require __DIR__ . '/../../conexion.php';

    // PREPARACIÓN (no formes parte de tu solución): deja la base lista
    require __DIR__ . '/../preparar.php';
    prepararEscenario($db, 'alumno21');

    $dni = '77777777A';
    $nuevaEdad = 21;

    // Prepara la consulta


    // Vincula los parámetros y ejecútala


    // Comprueba affected_rows y muestra el mensaje


    // Cierra sentencia y conexión

} catch (mysqli_sql_exception $e) {
    error_log($e->getMessage());
    http_response_code(500);
    echo 'No se pudo completar la operación.';
}
