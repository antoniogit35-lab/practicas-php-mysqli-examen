<?php
/*
  EJERCICIO 4: ACTUALIZAR UNA NOTA

  ENUNCIADO:
  Modifica la nota utilizando la clave completa de la matrícula:
  DNI, código y año. No actualices otras filas.

  OBJETIVO:
  Practica un WHERE con clave compuesta y el orden de los parámetros.

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
    $nuevaNota = 8.25;

    // Prepara la consulta


    // Vincula los parámetros y ejecútala


    // Comprueba affected_rows y muestra el mensaje


    // Cierra sentencia y conexión

} catch (mysqli_sql_exception $e) {
    error_log($e->getMessage());
    http_response_code(500);
    echo 'No se pudo completar la operación.';
}
