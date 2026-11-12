<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ejercicios medios de MySQLi</title>
  <link rel="stylesheet" href="css/estilos.css">
</head>
<body>

  <header class="cabecera">
    <h1>Ejercicios medios</h1>
    <p>Practica consultas preparadas de lectura: prepare, bind_param, execute, LIKE, JOIN y NULL.</p>
  </header>

  <div class="aviso">
    <p>
      <strong>Consejo:</strong>
      Si pulsas un botón y no aparece ningún resultado, revisa el log de
      errores de PHP. Antes de cerrar un ejercicio, cuenta los
      <strong>?</strong>, revisa la cadena de tipos y comprueba el orden de
      las variables.
    </p>
  </div>

  <main class="contenedor">

    <section class="ejercicio" id="ejercicio01">
      <h2>Ejercicio 1: Buscar por edad máxima</h2>
      <p>
        Muestra los alumnos con una edad inferior a <strong>22</strong>.
        Ordena por edad y nombre. Usa una consulta preparada y
        <code>get_result</code>.
      </p>
      <p class="esperado">
        <strong>Resultado esperado:</strong> Coincidencias: 2 —
        Ramón Torres (19) y María López (21)
      </p>
      <button onclick="ejecutar('01')">Ejecutar ejercicio</button>
      <div class="resultado" id="resultado01"></div>
    </section>

    <section class="ejercicio" id="ejercicio02">
      <h2>Ejercicio 2: Buscar por dos edades</h2>
      <p>
        Muestra los alumnos cuya edad sea exactamente <strong>21</strong> o
        <strong>24</strong>. Usa dos marcadores y vincula ambos enteros.
        Muestra nombre y edad, ordenados por edad.
      </p>
      <p class="esperado">
        <strong>Resultado esperado:</strong> María López (21) y
        Paloma Ruiz (24)
      </p>
      <button onclick="ejecutar('02')">Ejecutar ejercicio</button>
      <div class="resultado" id="resultado02"></div>
    </section>

    <section class="ejercicio" id="ejercicio03">
      <h2>Ejercicio 3: Buscar parte de un nombre</h2>
      <p>
        Busca los alumnos cuyo nombre contenga el texto <strong>lo</strong>.
        Construye el patrón con los comodines en la variable PHP, no en el
        SQL. Lee el resultado con <code>bind_result</code>. Muestra un
        mensaje si no hay coincidencias.
      </p>
      <p class="esperado">
        <strong>Resultado esperado:</strong> Coincidencias: 2 —
        María López (21) y Paloma Ruiz (24)
      </p>
      <button onclick="ejecutar('03')">Ejecutar ejercicio</button>
      <div class="resultado" id="resultado03"></div>
    </section>

    <section class="ejercicio" id="ejercicio04">
      <h2>Ejercicio 4: Filtrar matrículas por nota</h2>
      <p>
        Con una consulta preparada y un JOIN, muestra alumno, asignatura,
        año y nota de las matrículas con nota igual o superior a
        <strong>5</strong>. Ordena de mayor a menor nota.
      </p>
      <p class="esperado">
        <strong>Resultado esperado:</strong> 3 filas — Ramón Torres,
        Bases de datos, 2026, 8; Paloma Ruiz, Programación, 2025, 7;
        María López, Bases de datos, 2026, 6
      </p>
      <button onclick="ejecutar('04')">Ejecutar ejercicio</button>
      <div class="resultado" id="resultado04"></div>
    </section>

    <section class="ejercicio" id="ejercicio05">
      <h2>Ejercicio 5: Consultar por año</h2>
      <p>
        Recupera las matrículas del año <strong>2026</strong>: nombre del
        alumno, asignatura y nota. Si la nota es <code>NULL</code>, muestra
        «Pendiente».
      </p>
      <p class="esperado">
        <strong>Resultado esperado:</strong> 3 filas — María López, Bases de
        datos, 6; Ramón Torres, Bases de datos, 8; Ramón Torres,
        Programación, 4. Si ejecutas <code>sql/extra_nota_null.sql</code>,
        aparece además Isabel Perea, Lenguajes de marcas, Pendiente
      </p>
      <button onclick="ejecutar('05')">Ejecutar ejercicio</button>
      <div class="resultado" id="resultado05"></div>
    </section>

    <section class="ejercicio" id="ejercicio06">
      <h2>Ejercicio 6: Reutilizar una sentencia</h2>
      <p>
        Prepara <strong>una sola vez</strong> la consulta de alumnos por edad
        exacta y ejecútala para las edades <strong>24</strong> y
        <strong>25</strong> con un <code>foreach</code>. Muestra los nombres.
      </p>
      <p class="esperado">
        <strong>Resultado esperado:</strong> Paloma Ruiz e Isabel Perea
      </p>
      <button onclick="ejecutar('06')">Ejecutar ejercicio</button>
      <div class="resultado" id="resultado06"></div>
    </section>

    <section class="ejercicio" id="ejercicio07">
      <h2>Ejercicio 7: Contar con store_result</h2>
      <p>
        Muestra el DNI y el nombre de los alumnos menores de
        <strong>22</strong> años. Indica el total con
        <code>store_result</code> y <code>num_rows</code> <em>antes</em> de
        recorrer las filas.
      </p>
      <p class="esperado">
        <strong>Resultado esperado:</strong> Total: 2 —
        22222222B María López y 55555555Z Ramón Torres
      </p>
      <button onclick="ejecutar('07')">Ejecutar ejercicio</button>
      <div class="resultado" id="resultado07"></div>
    </section>

    <section class="ejercicio" id="ejercicio08">
      <h2>Ejercicio 8: El texto es un dato</h2>
      <p>
        Busca por nombre exacto el texto <code>' OR '1'='1</code> con una
        consulta preparada. Comprueba que se trata como un nombre y no
        altera el SQL. Muestra el número de coincidencias.
      </p>
      <p class="esperado">
        <strong>Resultado esperado:</strong> Coincidencias: 0
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
