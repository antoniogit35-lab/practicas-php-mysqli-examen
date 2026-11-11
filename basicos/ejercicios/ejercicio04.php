<?php
/*
  EJERCICIO 4: LISTAR ASIGNATURAS

  ENUNCIADO:
  Muestra el nombre y los créditos de las asignaturas, de más a menos
  créditos. Indica el total de asignaturas y presenta los datos en una tabla.

  OBJETIVO:
  Practica una consulta fija sobre otra tabla y el escape de la salida.

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
