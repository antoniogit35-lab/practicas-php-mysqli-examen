<?php
/*
  EJERCICIO 8: DNI DUPLICADO

  ENUNCIADO:
  El alumno 77777777A ya existe. Intenta insertarlo de nuevo.
  Captura el error de clave duplicada (código 1062) y muestra un mensaje
  comprensible. Cualquier otro error debe seguir su camino normal.

  OBJETIVO:
  Practica la captura selectiva de mysqli_sql_exception.

  PISTA:
  Consulta analisis.md si necesitas orientación.
*/

try {
    require __DIR__ . '/../../conexion.php';

    // PREPARACIÓN (no formes parte de tu solución): deja la base lista
    require __DIR__ . '/../preparar.php';
    prepararEscenario($db, 'alumno');

    $dni = '77777777A';
    $nombre = 'Ana Martín';
    $edad = 20;

    // Prepara la consulta y vincula los parámetros


    // Ejecuta dentro de un try interno y captura el duplicado (1062)


    // Cierra sentencia y conexión

} catch (mysqli_sql_exception $e) {
    error_log($e->getMessage());
    http_response_code(500);
    echo 'No se pudo completar la operación.';
}
