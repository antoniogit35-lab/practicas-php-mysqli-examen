<?php
/*
  EJERCICIO 6: REUTILIZAR UNA SENTENCIA

  ENUNCIADO:
  Prepara una sola vez la consulta de alumnos por edad exacta y ejecútala
  para las edades 24 y 25 con un foreach.
  Muestra los nombres.

  OBJETIVO:
  Entiende que bind_param conserva una referencia a la variable.

  PISTA:
  Consulta analisis.md si necesitas orientación.
*/

try {
    require __DIR__ . '/../../conexion.php';

    // Prepara la consulta una sola vez


    // Vincula la variable


    // Recorre las edades, ejecuta y muestra los nombres


    // Cierra sentencia y conexión

} catch (mysqli_sql_exception $e) {
    error_log($e->getMessage());
    http_response_code(500);
    echo 'No se pudo completar la operación.';
}
