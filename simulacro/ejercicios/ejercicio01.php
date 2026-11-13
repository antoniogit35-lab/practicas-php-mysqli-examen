<?php
/*
  EJERCICIO 1: INFORME DE UN ALUMNO

  ENUNCIADO:
  Prepara una consulta que reciba un DNI y muestre nombre del alumno,
  asignatura, año y nota de todas sus matrículas.
  Incluye alumnos aunque no tengan matrículas.
  Ordena por año descendente y asignatura.
  La consulta debe funcionar con cualquier DNI.

  Sin consultar los ejercicios anteriores.
*/

try {
    require __DIR__ . '/../../conexion.php';

    $dni = '22222222B';

    // Tu solución

} catch (mysqli_sql_exception $e) {
    error_log($e->getMessage());
    http_response_code(500);
    echo 'No se pudo completar la operación.';
}
