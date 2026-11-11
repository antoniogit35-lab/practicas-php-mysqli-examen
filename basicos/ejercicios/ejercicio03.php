<?php
/*
  EJERCICIO 3: ORDENAR Y LIMITAR

  ENUNCIADO:
  Muestra los dos alumnos de mayor edad.
  La consulta debe seleccionar solo nombre y edad y resolver tanto
  el orden como el límite en SQL.

  OBJETIVO:
  Practica ORDER BY y LIMIT.

  PISTA:
  Consulta analisis.md si necesitas orientación.
*/

try {
    require __DIR__ . '/../../conexion.php';

    // Ejecuta la consulta


    // Muestra el resultado


    // Libera el resultado y cierra la conexión

} catch (mysqli_sql_exception $e) {
    error_log($e->getMessage());
    http_response_code(500);
    echo 'No se pudo completar la operación.';
}
