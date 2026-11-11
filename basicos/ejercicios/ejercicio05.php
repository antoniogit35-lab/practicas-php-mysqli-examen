<?php
/*
  EJERCICIO 5: CONSULTA SIN COINCIDENCIAS

  ENUNCIADO:
  Busca los alumnos menores de 19 años (SQL fijo).
  Si no hay ninguno, muestra un mensaje informativo en lugar de una
  tabla vacía.

  OBJETIVO:
  Entiende que cero filas es un resultado correcto, no un error.

  PISTA:
  Consulta analisis.md si necesitas orientación.
*/

try {
    require __DIR__ . '/../../conexion.php';

    // Ejecuta la consulta


    // Muestra el mensaje o la tabla


    // Libera el resultado y cierra la conexión

} catch (mysqli_sql_exception $e) {
    error_log($e->getMessage());
    http_response_code(500);
    echo 'No se pudo completar la operación.';
}
