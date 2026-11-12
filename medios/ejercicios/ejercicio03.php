<?php
/*
  EJERCICIO 3: BUSCAR PARTE DE UN NOMBRE

  ENUNCIADO:
  Busca los alumnos cuyo nombre contenga el texto indicado.
  Construye el patrón con los comodines en la variable PHP, no dentro
  del SQL. Lee el resultado con bind_result.
  Muestra un mensaje si no hay coincidencias.

  OBJETIVO:
  Practica LIKE con consultas preparadas y bind_result.

  PISTA:
  Consulta analisis.md si necesitas orientación.
*/

try {
    require __DIR__ . '/../../conexion.php';

    $texto = 'lo';

    // Construye el patrón y prepara la consulta


    // Vincula el parámetro y ejecútala


    // Vincula las columnas, recorre las filas y muestra el resultado


    // Cierra sentencia y conexión

} catch (mysqli_sql_exception $e) {
    error_log($e->getMessage());
    http_response_code(500);
    echo 'No se pudo completar la operación.';
}
