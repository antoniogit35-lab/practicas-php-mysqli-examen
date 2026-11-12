<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ejercicios avanzados de MySQLi</title>
  <link rel="stylesheet" href="css/estilos.css">
</head>
<body>

  <header class="cabecera">
    <h1>Ejercicios avanzados</h1>
    <p>Practica INSERT, UPDATE y DELETE preparados, affected_rows y claves duplicadas.</p>
  </header>

  <div class="aviso">
    <p>
      <strong>Importante:</strong>
      Estos ejercicios modifican la base de datos. Antes de cada ejecución,
      <strong>preparar.php</strong> deja los datos de prueba en el estado
      necesario y, al terminar, elimina al alumno <strong>77777777A</strong>
      y sus matrículas. Puedes pulsar los botones las veces que quieras.
      Recuerda leer <code>affected_rows</code> justo después de
      <code>execute</code>.
    </p>
  </div>

  <main class="contenedor">

    <section class="ejercicio" id="ejercicio01">
      <h2>Ejercicio 1: Insertar un alumno</h2>
      <p>
        Inserta al alumno <strong>77777777A, Ana Martín, 20 años</strong>
        mediante una sentencia preparada. Vincula los tipos en el orden
        correcto y muestra cuántas filas se insertaron.
      </p>
      <p class="esperado">
        <strong>Resultado esperado:</strong> Insertados: 1
      </p>
      <button onclick="ejecutar('01')">Ejecutar ejercicio</button>
      <div class="resultado" id="resultado01"></div>
    </section>

    <section class="ejercicio" id="ejercicio02">
      <h2>Ejercicio 2: Actualizar una edad</h2>
      <p>
        Actualiza a <strong>21</strong> la edad del alumno
        <strong>77777777A</strong>. Distingue entre una fila modificada y
        ninguna fila modificada. Usa una consulta preparada.
      </p>
      <p class="esperado">
        <strong>Resultado esperado:</strong>
        Edad actualizada: 1 fila modificada
      </p>
      <button onclick="ejecutar('02')">Ejecutar ejercicio</button>
      <div class="resultado" id="resultado02"></div>
    </section>

    <section class="ejercicio" id="ejercicio03">
      <h2>Ejercicio 3: Insertar una matrícula</h2>
      <p>
        Inserta una matrícula para el alumno <strong>77777777A</strong> en la
        asignatura <strong>1</strong>, año <strong>2026</strong>, con nota
        <strong>7.5</strong>. Respeta el orden de los cuatro parámetros.
      </p>
      <p class="esperado">
        <strong>Resultado esperado:</strong> Insertadas: 1
      </p>
      <button onclick="ejecutar('03')">Ejecutar ejercicio</button>
      <div class="resultado" id="resultado03"></div>
    </section>

    <section class="ejercicio" id="ejercicio04">
      <h2>Ejercicio 4: Actualizar una nota</h2>
      <p>
        Cambia la nota a <strong>8.25</strong> usando la clave completa de la
        matrícula: DNI, código y año. No actualices otras filas.
      </p>
      <p class="esperado">
        <strong>Resultado esperado:</strong>
        Nota actualizada: 1 fila modificada
      </p>
      <button onclick="ejecutar('04')">Ejecutar ejercicio</button>
      <div class="resultado" id="resultado04"></div>
    </section>

    <section class="ejercicio" id="ejercicio05">
      <h2>Ejercicio 5: Eliminar una matrícula</h2>
      <p>
        Elimina únicamente la matrícula identificada por DNI, código y año.
        Muestra «Matrícula eliminada» si <code>affected_rows</code> vale 1 y
        «No encontrada» si vale 0.
      </p>
      <p class="esperado">
        <strong>Resultado esperado:</strong> Matrícula eliminada
      </p>
      <button onclick="ejecutar('05')">Ejecutar ejercicio</button>
      <div class="resultado" id="resultado05"></div>
    </section>

    <section class="ejercicio" id="ejercicio06">
      <h2>Ejercicio 6: Eliminar una matrícula inexistente</h2>
      <p>
        Intenta eliminar la matrícula de <strong>77777777A</strong>, código
        <strong>1</strong>, año <strong>1999</strong>. Usa el mismo mensaje
        que en el ejercicio anterior según <code>affected_rows</code>.
      </p>
      <p class="esperado">
        <strong>Resultado esperado:</strong> No encontrada
      </p>
      <button onclick="ejecutar('06')">Ejecutar ejercicio</button>
      <div class="resultado" id="resultado06"></div>
    </section>

    <section class="ejercicio" id="ejercicio07">
      <h2>Ejercicio 7: Actualizar sin cambiar nada</h2>
      <p>
        El alumno <strong>77777777A</strong> ya tiene 21 años. Actualiza su
        edad a <strong>21</strong> y explica el resultado según
        <code>affected_rows</code>.
      </p>
      <p class="esperado">
        <strong>Resultado esperado:</strong> Ninguna fila modificada
        (el alumno no existe o ya tenía ese valor)
      </p>
      <button onclick="ejecutar('07')">Ejecutar ejercicio</button>
      <div class="resultado" id="resultado07"></div>
    </section>

    <section class="ejercicio" id="ejercicio08">
      <h2>Ejercicio 8: DNI duplicado</h2>
      <p>
        El alumno <strong>77777777A</strong> ya existe. Intenta insertarlo de
        nuevo. Captura el error de clave duplicada (código 1062) y muestra un
        mensaje comprensible. Cualquier otro error debe seguir su camino
        normal.
      </p>
      <p class="esperado">
        <strong>Resultado esperado:</strong> Ese DNI ya existe.
      </p>
      <button onclick="ejecutar('08')">Ejecutar ejercicio</button>
      <div class="resultado" id="resultado08"></div>
    </section>

  </main>

  <script>
    async function ejecutar(numero) {
      const salida = document.querySelector('#resultado' + numero);
      salida.textContent = 'Ejecutando…';
      try {
        const respuesta = await fetch('ejercicios/ejercicio' + numero + '.php');
        const texto = await respuesta.text();
        if (!respuesta.ok) {
          salida.textContent = texto.trim() ||
            'Error ' + respuesta.status + ': revisa el log de errores de PHP.';
          return;
        }
        salida.innerHTML = texto.trim() || '(El ejercicio no ha mostrado nada)';
      } catch (error) {
        salida.textContent =
          'No se pudo ejecutar. ¿Estás abriendo la página desde el servidor PHP?';
      }
    }
  </script>

</body>
</html>
