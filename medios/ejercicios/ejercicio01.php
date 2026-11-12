<?php
/*
  EJERCICIO 1: BUSCAR POR EDAD MÁXIMA

  ENUNCIADO:
  Prepara una consulta que muestre los alumnos con una edad inferior
  al valor indicado. Ordena el resultado por edad y nombre.
  Utiliza get_result.

  OBJETIVO:
  Practica el ciclo prepare, bind_param, execute y get_result.

  PISTA:
  Consulta analisis.md si necesitas orientación.
*/

try {
    require __DIR__ . '/../../conexion.php';

    $limite = 22;

    // Prepara la consulta


    // Vincula el parámetro y ejecútala


    // Lee y muestra el resultado


    // Cierra resultado, sentencia y conexión

} catch (mysqli_sql_exception $e) {
    error_log($e->getMessage());
    http_response_code(500);
    echo 'No se pudo completar la operación.';
}
