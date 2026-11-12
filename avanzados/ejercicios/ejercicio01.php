<?php
/*
  EJERCICIO 1: INSERTAR UN ALUMNO

  ENUNCIADO:
  Inserta el alumno indicado mediante una sentencia preparada.
  Vincula los tipos en el orden correcto y muestra cuántas filas
  se insertaron.

  OBJETIVO:
  Practica INSERT preparado, bind_param con ssi y affected_rows.

  PISTA:
  Consulta analisis.md si necesitas orientación.
*/

try {
    require __DIR__ . '/../../conexion.php';

    // PREPARACIÓN (no formes parte de tu solución): deja la base lista
    require __DIR__ . '/../preparar.php';
    prepararEscenario($db, 'limpio');

    $dni = '77777777A';
    $nombre = 'Ana Martín';
    $edad = 20;

    // Prepara la consulta


    // Vincula los parámetros y ejecútala


    // Muestra cuántas filas se insertaron


    // Cierra sentencia y conexión

} catch (mysqli_sql_exception $e) {
    error_log($e->getMessage());
    http_response_code(500);
    echo 'No se pudo completar la operación.';
}
