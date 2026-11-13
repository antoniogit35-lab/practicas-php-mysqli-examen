<?php
/*
  PREPARACIÓN DEL SIMULACRO (solo para practicar).

  Elimina al alumno de prueba 88888888B y sus matrículas antes de ejecutar el
  ejercicio y, al terminar el script, vuelve a eliminarlos. En el examen no
  existirá nada parecido.
*/

function prepararSimulacro(mysqli $db): void
{
    static $registrada = false;
    if (!$registrada) {
        $registrada = true;
        register_shutdown_function(function () {
            try {
                require __DIR__ . '/../conexion.php';
                $db->query("DELETE FROM matriculas WHERE dni = '88888888B'");
                $db->query("DELETE FROM alumnos WHERE dni = '88888888B'");
                $db->close();
            } catch (Throwable $e) {
                error_log($e->getMessage());
            }
        });
    }

    $db->query("DELETE FROM matriculas WHERE dni = '88888888B'");
    $db->query("DELETE FROM alumnos WHERE dni = '88888888B'");
}
