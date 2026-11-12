<?php
/*
  EJERCICIO 6: ELIMINAR UNA MATRÍCULA INEXISTENTE

  ENUNCIADO:
  Intenta eliminar la matrícula de 77777777A, código 1, año 1999.
  Usa el mismo mensaje que en el ejercicio anterior según affected_rows.

  OBJETIVO:
  Entiende que borrar cero filas no es un error SQL.

  PISTA:
  Consulta analisis.md si necesitas orientación.
*/

try {
    require __DIR__ . '/../../conexion.php';

    // PREPARACIÓN (no formes parte de tu solución): deja la base lista
    require __DIR__ . '/../preparar.php';
    prepararEscenario($db, 'matricula');

    $dni = '77777777A';
    $codigo = 1;
    $anio = 1999;

    // Prepara la consulta


    // Vincula los parámetros y ejecútala


    // Comprueba affected_rows y muestra el mensaje


    // Cierra sentencia y conexión

} catch (mysqli_sql_exception $e) {
    error_log($e->getMessage());
    http_response_code(500);
    echo 'No se pudo completar la operación.';
}
