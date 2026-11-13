<?php
/*
  EJERCICIO 4: INFORME DE UN ALUMNO SIN MATRÍCULAS

  ENUNCIADO:
  Ejecuta el informe del ejercicio 1 con el DNI 44444444R.
  El alumno existe pero no tiene matrículas: debe aparecer su nombre y un
  aviso, no una tabla vacía.
  Si el DNI no existe, muestra «Alumno no encontrado».

  Sin consultar los ejercicios anteriores.
*/

try {
    require __DIR__ . '/../../conexion.php';

    $dni = '44444444R';

    // Tu solución

} catch (mysqli_sql_exception $e) {
    error_log($e->getMessage());
    http_response_code(500);
    echo 'No se pudo completar la operación.';
}
