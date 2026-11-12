<?php
/*
  EJERCICIO 7: CONTAR CON STORE_RESULT

  ENUNCIADO:
  Muestra el DNI y el nombre de los alumnos menores de la edad indicada.
  Indica el total con store_result y num_rows antes de recorrer las filas.

  OBJETIVO:
  Practica store_result, num_rows, bind_result y free_result.

  PISTA:
  Consulta analisis.md si necesitas orientación.
*/

try {
    require __DIR__ . '/../../conexion.php';

    $limite = 22;

    // Prepara la consulta


    // Vincula el parámetro, ejecuta y almacena el resultado


    // Muestra el total, vincula las columnas y recorre las filas


    // Libera, cierra sentencia y conexión

} catch (mysqli_sql_exception $e) {
    error_log($e->getMessage());
    http_response_code(500);
    echo 'No se pudo completar la operación.';
}
