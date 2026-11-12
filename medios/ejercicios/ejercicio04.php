<?php
/*
  EJERCICIO 4: FILTRAR MATRÍCULAS POR NOTA

  ENUNCIADO:
  Mediante una consulta preparada y un JOIN, muestra alumno, asignatura,
  año y nota para las matrículas cuya nota sea igual o superior al mínimo.
  Ordena de mayor a menor nota.

  OBJETIVO:
  Practica JOIN, alias y un parámetro decimal.

  PISTA:
  Consulta analisis.md si necesitas orientación.
*/

try {
    require __DIR__ . '/../../conexion.php';

    $notaMinima = 5;

    // Prepara la consulta


    // Vincula el parámetro y ejecútala


    // Lee y muestra el resultado


    // Cierra resultado, sentencia y conexión

} catch (mysqli_sql_exception $e) {
    error_log($e->getMessage());
    http_response_code(500);
    echo 'No se pudo completar la operación.';
}
