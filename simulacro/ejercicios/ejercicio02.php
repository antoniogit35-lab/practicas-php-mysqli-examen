<?php
/*
  EJERCICIO 2: ALTA SEGURA COMPLETA

  ENUNCIADO:
  Inserta un alumno nuevo mediante una sentencia preparada.
  Después inserta una matrícula para ese alumno mediante otra sentencia
  preparada.
  Si alguna operación falla, muestra un mensaje general y registra el error.
  No reutilices SQL concatenado.

  Sin consultar los ejercicios anteriores.
*/

try {
    require __DIR__ . '/../../conexion.php';

    // PREPARACIÓN (no formes parte de tu solución): deja la base lista
    require __DIR__ . '/../preparar.php';
    prepararSimulacro($db);

    $dni = '88888888B';
    $nombre = 'Luis Pérez';
    $edad = 22;
    $codigo = 3;
    $anio = 2026;
    $nota = 6.5;

    // Tu solución

} catch (mysqli_sql_exception $e) {
    error_log($e->getMessage());
    http_response_code(500);
    echo 'No se pudo completar la operación.';
}
