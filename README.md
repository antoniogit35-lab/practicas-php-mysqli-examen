# Prácticas PHP + MySQLi — Examen Tema 9 DWES

Repositorio de ejercicios para preparar el examen del **Tema 9: Acceso a bases
de datos** de Desarrollo Web en Entorno Servidor (curso 2026/2027).

Cubre conexión con MySQLi, lectura de resultados, consultas preparadas, CRUD y
JOIN. Incluye un simulacro que replica la relación de preexamen del profesor.

## Organización del repositorio

```text
practicas-php-mysqli-examen/
├── README.md
├── .gitignore
├── conexion.example.php
├── sql/
│   ├── centro.sql
│   └── extra_nota_null.sql
├── guia/
│   └── estructuras.md
├── basicos/
│   ├── index.php
│   ├── analisis.md
│   ├── css/
│   ├── ejercicios/
│   └── soluciones/
├── medios/
│   ├── index.php
│   ├── analisis.md
│   ├── css/
│   ├── ejercicios/
│   └── soluciones/
├── avanzados/
│   ├── index.php
│   ├── preparar.php
│   ├── analisis.md
│   ├── css/
│   ├── ejercicios/
│   └── soluciones/
└── simulacro/
    ├── index.php
    ├── preparar.php
    ├── analisis.md
    ├── css/
    ├── ejercicios/
    └── soluciones/
```

## Base de datos `centro`

| Tabla | Columnas | Clave |
|---|---|---|
| alumnos | dni, nombre, edad | dni |
| asignaturas | codigo, nombre, creditos, trimestre | codigo |
| matriculas | dni, codigo, anio, nota | dni + codigo + anio |

Datos iniciales: 4 alumnos, 3 asignaturas y 5 matrículas.

## Niveles

| Nivel | Ejercicios | Contenido | Preexamen |
|---|---|---|---|
| basicos | 6 | Conexión, SELECT fijo, `fetch_assoc`, tabla HTML, `ORDER BY`, `LIMIT`, JOIN | 01, 02, 03 |
| medios | 8 | Consultas preparadas de lectura: `bind_param`, `get_result`, `bind_result`, `LIKE`, JOIN, NULL, `store_result` | 04 a 08 |
| avanzados | 8 | INSERT, UPDATE y DELETE preparados, `affected_rows`, clave compuesta, clave duplicada | 09 a 13 |
| simulacro | 4 | Informe con LEFT JOIN, alta completa, código inseguro | 14, 15, 16 |

Los ejercicios 1 a 3 de `basicos`, 1 a 5 de `medios`, 1 a 5 de `avanzados` y
1 a 3 de `simulacro` replican la relación de preexamen del profesor. El resto
son variantes para practicar el mismo patrón.

## Cómo ponerlo en marcha

Requisitos: PHP 8.2 o posterior con la extensión `mysqli` (y `mysqlnd`), y
MySQL o MariaDB.

1. Importa `sql/centro.sql` con tu cliente SQL (una sola vez).
2. Crea el usuario `dwes_app` con permisos sobre `centro` (hay un ejemplo
   comentado al final del script).
3. Copia `conexion.example.php` como `conexion.php` y pon tu clave.
   `conexion.php` está en `.gitignore`: no se sube al repositorio.
4. Arranca un servidor PHP desde la raíz del repo:

   ```bash
   php -S localhost:8000
   ```

5. Abre cada nivel en el navegador:

   - `http://localhost:8000/basicos/`
   - `http://localhost:8000/medios/`
   - `http://localhost:8000/avanzados/`
   - `http://localhost:8000/simulacro/`

## Orden de estudio recomendado

1. Lee `guia/estructuras.md`.
2. Haz `basicos`, `medios` y `avanzados` en ese orden.
3. Cuando los domines, haz `simulacro` **sin consultar** la guía ni los niveles
   anteriores.

## Cómo trabajar los ejercicios

Cada nivel tiene su propia página `index.php`, con un recuadro por ejercicio:
enunciado, resultado esperado, un botón para ejecutarlo y un espacio para el
resultado.

1. Lee el enunciado en la página del nivel.
2. Abre la plantilla en `ejercicios/ejercicioNN.php` y escribe tu solución.
3. Pulsa el botón en la página y compara con el resultado esperado.
4. Si te atascas, consulta `analisis.md`: preguntas y pistas por ejercicio.
5. Mira `soluciones/ejercicioNN.php` solo después de haberlo intentado.

Cada ejercicio es un archivo independiente: un error en uno no rompe los demás.

## Limpieza automática (avanzados y simulacro)

Los ejercicios de `avanzados` y el ejercicio 2 de `simulacro` modifican la base
de datos. Para poder repetirlos:

- `avanzados/preparar.php` y `simulacro/preparar.php` dejan los datos de prueba
  en el estado que necesita cada ejercicio.
- Al terminar el script, eliminan al alumno de prueba (`77777777A` en
  `avanzados`, `88888888B` en `simulacro`) y sus matrículas.
- Los datos iniciales de `centro` no se tocan.

Esto es solo para practicar. En el examen no habrá nada parecido: tendrás que
partir del estado que te den.

## Datos extra opcionales

`sql/extra_nota_null.sql` añade una matrícula sin calificar para practicar el
mensaje «Pendiente» del ejercicio 5 de `medios`. Incluye al final la sentencia
que lo deshace.

## Reglas del examen

- Usa la interfaz orientada a objetos de MySQLi.
- Toda consulta con valores variables debe ser preparada.
- Escapa con `htmlspecialchars` los textos que se muestren en HTML.
- Los resultados deben salir de la consulta, no escribirse a mano.

## Lista de comprobación

Antes de dar un ejercicio por terminado:

- Cuenta los signos `?`.
- Revisa la cadena de tipos de `bind_param`.
- Comprueba el orden de las variables.
- Ejecuta la sentencia.
- Recorre todas las filas.
- Usa `affected_rows` en operaciones de escritura.
- Cierra resultado, sentencia y conexión.

## Si no aparece nada o hay un error

- Revisa que `conexion.php` exista y que la clave sea correcta.
- Comprueba que `mysqli` está habilitada (`php -m`).
- Abre la página desde `php -S`, no con doble clic en el archivo.
- Mira el log de errores de PHP y la consola del navegador (`F12`).
- Errores típicos: número de `?` distinto al de variables, tipos mal escritos
  en `bind_param`, olvidar `execute()` y usar `"?"` entre comillas.
- Si queda un alumno de prueba sin borrar en `centro`, elimínalo a mano:
  `DELETE FROM matriculas WHERE dni IN ('77777777A', '88888888B');` y
  `DELETE FROM alumnos WHERE dni IN ('77777777A', '88888888B');`.

## Material de origen

Ejercicios basados en la relación de preexamen y en los apuntes del Tema 9
(consultas iniciales y consultas preparadas).
