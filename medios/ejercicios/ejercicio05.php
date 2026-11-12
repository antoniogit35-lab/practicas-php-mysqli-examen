<?php
/*
  EJERCICIO 5: CONSULTAR POR AÑO

  ENUNCIADO:
  Recupera las matrículas de un año concreto. Deben aparecer el nombre
  del alumno, la asignatura y la nota.
  Si la nota es NULL, muestra «Pendiente».

  OBJETIVO:
  Practica JOIN, parámetros enteros y el tratamiento de NULL.

  PISTA:
  Consulta analisis.md si necesitas orientación.
*/

try {
    require __DIR__ . '/../../conexion.php';

    $anio = 2026;

    // Prepara la consulta


    // Vincula el parámetro y ejecútala


    // Lee y muestra el resultado (nota NULL = Pendiente)


    // Cierra resultado, sentencia y conexión

} catch (mysqli_sql_exception $e) {
    error_log($e->getMessage());
    http_response_code(500);
    echo 'No se pudo completar la operación.';
}
