<?php
/*
  EJERCICIO 8: EL TEXTO ES UN DATO

  ENUNCIADO:
  Busca por nombre exacto el texto indicado con una consulta preparada.
  Comprueba que se trata como un nombre y no altera el SQL.
  Muestra el número de coincidencias.

  OBJETIVO:
  Entiende por qué la consulta preparada separa instrucciones y valores.

  PISTA:
  Consulta analisis.md si necesitas orientación.
*/

try {
    require __DIR__ . '/../../conexion.php';

    $nombre = "' OR '1'='1";

    // Prepara la consulta


    // Vincula el parámetro y ejecútala


    // Muestra el número de coincidencias


    // Cierra resultado, sentencia y conexión

} catch (mysqli_sql_exception $e) {
    error_log($e->getMessage());
    http_response_code(500);
    echo 'No se pudo completar la operación.';
}
