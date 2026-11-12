<?php
/*
  EJERCICIO 3: INSERTAR UNA MATRÍCULA

  ENUNCIADO:
  Inserta una matrícula para un alumno y una asignatura existentes.
  La nota será numérica. Respeta el orden de los cuatro parámetros.

  OBJETIVO:
  Practica una cadena de tipos con cuatro parámetros distintos.

  PISTA:
  Consulta analisis.md si necesitas orientación.
*/

try {
    require __DIR__ . '/../../conexion.php';

    // PREPARACIÓN (no formes parte de tu solución): deja la base lista
    require __DIR__ . '/../preparar.php';
    prepararEscenario($db, 'alumno');

    $dni = '77777777A';
    $codigo = 1;
    $anio = 2026;
    $nota = 7.5;

    // Prepara la consulta


    // Vincula los parámetros y ejecútala


    // Muestra cuántas filas se insertaron


    // Cierra sentencia y conexión

} catch (mysqli_sql_exception $e) {
    error_log($e->getMessage());
    http_response_code(500);
    echo 'No se pudo completar la operación.';
}
