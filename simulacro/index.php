<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Simulacro de examen de MySQLi</title>
  <link rel="stylesheet" href="css/estilos.css">
</head>
<body>

  <header class="cabecera">
    <h1>Simulacro de examen</h1>
    <p>Réplica de la simulación final del preexamen: informe, alta completa y código inseguro.</p>
  </header>

  <div class="aviso">
    <p>
      <strong>Reglas:</strong>
      Resuelve estos ejercicios <strong>sin consultar</strong> la guía ni los
      niveles anteriores. Usa la interfaz orientada a objetos de MySQLi,
      consultas preparadas para cualquier valor variable y
      <code>htmlspecialchars</code> en todo texto que muestres.
      El ejercicio 2 escribe en la base: <strong>preparar.php</strong>
      elimina al alumno <strong>88888888B</strong> antes y después de
      ejecutarlo.
    </p>
  </div>

  <main class="contenedor">

    <section class="ejercicio" id="ejercicio01">
      <h2>Ejercicio 1: Informe de un alumno</h2>
      <p>
        Prepara una consulta que reciba un DNI y muestre el nombre del
        alumno, la asignatura, el año y la nota de todas sus matrículas.
        <strong>Incluye alumnos aunque no tengan matrículas.</strong> Ordena
        por año descendente y asignatura. La consulta debe funcionar con
        cualquier DNI. Prueba con <code>22222222B</code>.
      </p>
      <p class="esperado">
        <strong>Resultado esperado:</strong> María López — Bases de datos,
        2026, 6; María López — Bases de datos, 2025, 4
      </p>
      <button onclick="ejecutar('01')">Ejecutar ejercicio</button>
      <div class="resultado" id="resultado01"></div>
    </section>

    <section class="ejercicio" id="ejercicio02">
      <h2>Ejercicio 2: Alta segura completa</h2>
      <p>
        Inserta un alumno nuevo (<code>88888888B</code>, Luis Pérez, 22
        años) mediante una sentencia preparada. Después inserta una
        matrícula para ese alumno (asignatura 3, año 2026, nota 6.5)
        mediante otra sentencia preparada. Si alguna operación falla,
        muestra un mensaje general y registra el error. No reutilices SQL
        concatenado.
      </p>
      <p class="esperado">
        <strong>Resultado esperado:</strong> Alumno insertado: 1 —
        Matrícula insertada: 1
      </p>
      <button onclick="ejecutar('02')">Ejecutar ejercicio</button>
      <div class="resultado" id="resultado02"></div>
    </section>

    <section class="ejercicio" id="ejercicio03">
      <h2>Ejercicio 3: Corregir código inseguro</h2>
      <p>
        Reescribe el fragmento de la plantilla utilizando una sentencia
        preparada. Escapa el nombre antes de mostrarlo. Explica en un
        comentario por qué no debe concatenarse el valor.
      </p>
      <p class="esperado">
        <strong>Resultado esperado:</strong> Con «María López»,
        1 coincidencia (22222222B). Con <code>' OR '1'='1</code>,
        0 coincidencias
      </p>
      <label for="nombre03">Nombre a buscar:</label>
      <input id="nombre03" type="text" value="María López">
      <button onclick="ejecutar('03', '?nombre=' + encodeURIComponent(document.querySelector('#nombre03').value))">Ejecutar ejercicio</button>
      <div class="resultado" id="resultado03"></div>
    </section>

    <section class="ejercicio" id="ejercicio04">
      <h2>Ejercicio 4: Informe de un alumno sin matrículas</h2>
      <p>
        Ejecuta el informe del ejercicio 1 con el DNI
        <code>44444444R</code>. El alumno existe pero no tiene matrículas:
        debe aparecer su nombre y un aviso, no una tabla vacía. Si el DNI no
        existe, muestra «Alumno no encontrado».
      </p>
      <p class="esperado">
        <strong>Resultado esperado:</strong> Alumno: Isabel Perea —
        Sin matrículas
      </p>
      <button onclick="ejecutar('04')">Ejecutar ejercicio</button>
      <div class="resultado" id="resultado04"></div>
    </section>

  </main>

  <script>
    async function ejecutar(numero, consulta) {
      const salida = document.querySelector('#resultado' + numero);
      salida.textContent = 'Ejecutando…';
      try {
        const url = 'ejercicios/ejercicio' + numero + '.php' + (consulta || '');
        const respuesta = await fetch(url);
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
