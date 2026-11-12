<?php
/*
  EJERCICIO 2: BUSCAR POR DOS EDADES

  ENUNCIADO:
  Muestra los alumnos cuya edad sea exactamente una de las dos indicadas.
  Utiliza dos marcadores, vincula ambos enteros y muestra nombre y edad,
  ordenados por edad.

  OBJETIVO:
  Practica una consulta con dos parámetros y su cadena de tipos.

  PISTA:
  Consulta analisis.md si necesitas orientación.
*/

try {
    require __DIR__ . '/../../conexion.php';

    $edad1 = 21;
    $edad2 = 24;

    // Prepara la consulta


    // Vincula los parámetros y ejecútala


    // Lee y muestra el resultado


    // Cierra resultado, sentencia y conexión

} catch (mysqli_sql_exception $e) {
    error_log($e->getMessage());
    http_response_code(500);
    echo 'No se pudo completar la operación.';
}
