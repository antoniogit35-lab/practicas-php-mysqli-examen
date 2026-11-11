<?php
/*
  EJERCICIO 6: RELACIONAR DATOS CON JOIN

  ENUNCIADO:
  Muestra alumno, asignatura, año y nota de todas las matrículas.
  Ordena por alumno, año y asignatura.
  Usa alias para que no se repitan los nombres de columna.

  OBJETIVO:
  Practica JOIN entre tres tablas y alias de columna.

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
