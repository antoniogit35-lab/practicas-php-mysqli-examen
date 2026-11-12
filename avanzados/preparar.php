<?php
/*
  PREPARACIÓN DE LOS EJERCICIOS (solo para practicar).

  Deja la base en el estado que necesita cada ejercicio y, al terminar el
  script, elimina el alumno de prueba y sus matrículas para que centro vuelva
  a tener los datos iniciales. En el examen no existirá nada parecido.
*/

function prepararEscenario(mysqli $db, string $escenario): void
{
    // Limpieza final automática, aunque el ejercicio falle
    static $registrada = false;
    if (!$registrada) {
        $registrada = true;
        register_shutdown_function(function () {
            try {
                require __DIR__ . '/../conexion.php';
                $db->query("DELETE FROM matriculas WHERE dni = '77777777A'");
                $db->query("DELETE FROM alumnos WHERE dni = '77777777A'");
                $db->close();
            } catch (Throwable $e) {
                error_log($e->getMessage());
            }
        });
    }

    // Estado limpio de partida
    $db->query("DELETE FROM matriculas WHERE dni = '77777777A'");
    $db->query("DELETE FROM alumnos WHERE dni = '77777777A'");

    if ($escenario === 'alumno' || $escenario === 'matricula') {
        $db->query(
            "INSERT INTO alumnos (dni, nombre, edad)
             VALUES ('77777777A', 'Ana Martín', 20)"
        );
    }

    if ($escenario === 'alumno21') {
        $db->query(
            "INSERT INTO alumnos (dni, nombre, edad)
             VALUES ('77777777A', 'Ana Martín', 21)"
        );
    }

    if ($escenario === 'matricula') {
        $db->query(
            "INSERT INTO matriculas (dni, codigo, anio, nota)
             VALUES ('77777777A', 1, 2026, 7.5)"
        );
    }
}
