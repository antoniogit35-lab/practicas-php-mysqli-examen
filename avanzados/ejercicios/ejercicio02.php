<?php
/*
  EJERCICIO 2: ACTUALIZAR UNA EDAD

  ENUNCIADO:
  Actualiza la edad del alumno identificado por su DNI.
  Distingue entre una fila modificada y ninguna fila modificada.
  Utiliza una consulta preparada.

  OBJETIVO:
  Practica UPDATE preparado, bind_param con is y affected_rows.

  PISTA:
  Consulta analisis.md si necesitas orientación.
*/

try {
    require __DIR__ . '/../../conexion.php';

    // PREPARACIÓN (no formes parte de tu solución): deja la base lista
    require __DIR__ . '/../preparar.php';
    prepararEscenario($db, 'alumno');

    $dni = '77777777A';
    $nuevaEdad = 21;

    // Prepara la consulta


    // Vincula los parámetros y ejecútala


    // Comprueba affected_rows y muestra el mensaje


    // Cierra sentencia y conexión

} catch (mysqli_sql_exception $e) {
    error_log($e->getMessage());
    http_response_code(500);
    echo 'No se pudo completar la operación.';
}
