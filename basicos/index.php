<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ejercicios básicos de MySQLi</title>
  <link rel="stylesheet" href="css/estilos.css">
</head>
<body>

  <header class="cabecera">
    <h1>Ejercicios básicos</h1>
    <p>Practica la conexión, SELECT con SQL fijo, tablas HTML, ORDER BY, LIMIT y JOIN.</p>
  </header>

  <div class="aviso">
    <p>
      <strong>Consejo:</strong>
      Si pulsas un botón y no aparece ningún resultado, revisa el log de
      errores de PHP y comprueba que existe <strong>conexion.php</strong>
      (cópialo desde conexion.example.php). También puedes abrir la consola
      del navegador con <strong>F12</strong>.
    </p>
  </div>

  <main class="contenedor">

    <section class="ejercicio" id="ejercicio01">
      <h2>Ejercicio 1: Comprobar la conexión</h2>
      <p>
        Conecta con la base <strong>centro</strong> usando el modo estricto y
        <strong>utf8mb4</strong>. Muestra «Conexión correcta». Controla
        <code>mysqli_sql_exception</code> sin mostrar datos internos.
      </p>
      <p class="esperado">
        <strong>Resultado esperado:</strong> Conexión correcta
      </p>
      <button onclick="ejecutar('01')">Ejecutar ejercicio</button>
      <div class="resultado" id="resultado01"></div>
    </section>

    <section class="ejercicio" id="ejercicio02">
      <h2>Ejercicio 2: Listar alumnos</h2>
      <p>
        Recupera el nombre y la edad de todos los alumnos, ordenados por
        nombre. Muestra el total de filas y después una tabla HTML. Libera el
        resultado y cierra la conexión.
      </p>
      <p class="esperado">
        <strong>Resultado esperado:</strong> Total: 4 y una tabla con
        Isabel Perea (25), María López (21), Paloma Ruiz (24) y
        Ramón Torres (19)
      </p>
      <button onclick="ejecutar('02')">Ejecutar ejercicio</button>
      <div class="resultado" id="resultado02"></div>
    </section>

    <section class="ejercicio" id="ejercicio03">
      <h2>Ejercicio 3: Ordenar y limitar</h2>
      <p>
        Muestra los <strong>dos alumnos de mayor edad</strong>. La consulta
        debe seleccionar solo nombre y edad y resolver el orden y el límite
        en SQL.
      </p>
      <p class="esperado">
        <strong>Resultado esperado:</strong> Isabel Perea (25) y
        Paloma Ruiz (24)
      </p>
      <button onclick="ejecutar('03')">Ejecutar ejercicio</button>
      <div class="resultado" id="resultado03"></div>
    </section>

    <section class="ejercicio" id="ejercicio04">
      <h2>Ejercicio 4: Listar asignaturas</h2>
      <p>
        Muestra el nombre y los créditos de las asignaturas, de más a menos
        créditos. Indica el total de asignaturas y presenta los datos en una
        tabla.
      </p>
      <p class="esperado">
        <strong>Resultado esperado:</strong> Total: 3 y una tabla con
        Lenguajes de marcas (23), Programación (18) y Bases de datos (15)
      </p>
      <button onclick="ejecutar('04')">Ejecutar ejercicio</button>
      <div class="resultado" id="resultado04"></div>
    </section>

    <section class="ejercicio" id="ejercicio05">
      <h2>Ejercicio 5: Consulta sin coincidencias</h2>
      <p>
        Busca los alumnos menores de <strong>19</strong> años (SQL fijo). Si
        no hay ninguno, muestra un mensaje informativo en lugar de una tabla
        vacía.
      </p>
      <p class="esperado">
        <strong>Resultado esperado:</strong>
        No hay alumnos con esa condición.
      </p>
      <button onclick="ejecutar('05')">Ejecutar ejercicio</button>
      <div class="resultado" id="resultado05"></div>
    </section>

    <section class="ejercicio" id="ejercicio06">
      <h2>Ejercicio 6: Relacionar datos con JOIN</h2>
      <p>
        Muestra alumno, asignatura, año y nota de todas las matrículas.
        Ordena por alumno, año y asignatura. Usa alias para que no se
        repitan los nombres de columna.
      </p>
      <p class="esperado">
        <strong>Resultado esperado:</strong> 5 filas. Primera:
        María López, Bases de datos, 2025, 4. Última:
        Ramón Torres, Programación, 2026, 4
      </p>
      <button onclick="ejecutar('06')">Ejecutar ejercicio</button>
      <div class="resultado" id="resultado06"></div>
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
