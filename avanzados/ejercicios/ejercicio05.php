<?php
/*
  EJERCICIO 5: ELIMINAR UNA MATRÍCULA

  ENUNCIADO:
  Elimina únicamente la matrícula identificada por DNI, código y año.
  Muestra «Matrícula eliminada» si affected_rows vale 1 y
  «No encontrada» si vale 0.

  OBJETIVO:
  Practica DELETE preparado y la lectura de affected_rows.

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
    $anio = 2026;

    // Prepara la consulta


    // Vincula los parámetros y ejecútala


    // Comprueba affected_rows y muestra el mensaje


    // Cierra sentencia y conexión

} catch (mysqli_sql_exception $e) {
    error_log($e->getMessage());
    http_response_code(500);
    echo 'No se pudo completar la operación.';
}
