<?php
/*
  EJERCICIO 2: LISTAR ALUMNOS

  ENUNCIADO:
  Recupera el nombre y la edad de todos los alumnos, ordenados por nombre.
  Muestra el total de filas y después una tabla HTML.
  Libera el resultado y cierra la conexión.

  OBJETIVO:
  Practica query, num_rows, fetch_assoc y el escape de la salida.

  PISTA:
  Consulta analisis.md si necesitas orientación.
*/

try {
    require __DIR__ . '/../../conexion.php';

    // Ejecuta la consulta


    // Muestra el total y la tabla


    // Libera el resultado y cierra la conexión

} catch (mysqli_sql_exception $e) {
    error_log($e->getMessage());
    http_response_code(500);
    echo 'No se pudo completar la operación.';
}
