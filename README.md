# Prácticas PHP + MySQLi — Examen Tema 9 DWES

Repositorio de ejercicios para preparar el examen del **Tema 9: Acceso a bases
de datos** de Desarrollo Web en Entorno Servidor (curso 2026/2027).

Cubre conexión con MySQLi, lectura de resultados, consultas preparadas, CRUD y
JOIN. Incluye un simulacro que replica la relación de preexamen del profesor.

## Inicio rápido (Windows + XAMPP)

Requisito: XAMPP instalado, con **MySQL** en verde en su panel de control
(Apache solo se usa para abrir phpMyAdmin).

1. **Base de datos.** Abre `http://localhost/phpmyadmin`, ve a la pestaña
   *Importar* y sube `sql/centro.sql`. Debe crearse la base `centro` con 4
   alumnos, 3 asignaturas y 5 matrículas.
2. **Usuario de la aplicación.** En la pestaña *SQL* de phpMyAdmin ejecuta
   (cambia `TU_CLAVE` por la clave que quieras usar):

   ```sql
   CREATE USER 'dwes_app'@'localhost' IDENTIFIED BY 'TU_CLAVE';
   GRANT SELECT, INSERT, UPDATE, DELETE ON centro.* TO 'dwes_app'@'localhost';
   FLUSH PRIVILEGES;
   ```

   Si dice que el usuario ya existe, ponle la clave y los permisos con:

   ```sql
   ALTER USER 'dwes_app'@'localhost' IDENTIFIED BY 'TU_CLAVE';
   GRANT SELECT, INSERT, UPDATE, DELETE ON centro.* TO 'dwes_app'@'localhost';
   FLUSH PRIVILEGES;
   ```

3. **Conexión.** Desde la carpeta del repositorio, en PowerShell:

   ```powershell
   Copy-Item conexion.example.php conexion.php
   ```

   Abre `conexion.php` y pon la misma `TU_CLAVE`. Este archivo está en
   `.gitignore`: no se sube al repositorio.
4. **Servidor.** Desde la carpeta del repositorio, arranca el servidor de PHP
   que trae XAMPP:

   ```powershell
   & "C:\xampp\php\php.exe" -S localhost:8000
   ```

   Deja esa ventana abierta mientras practicas. Si instalaste XAMPP en otra
   carpeta, cambia la ruta. Si prefieres escribir solo `php -S localhost:8000`,
   añade `C:\xampp\php` a la variable de entorno `Path` y abre una ventana
   nueva de PowerShell.
5. **Abrir los niveles** en el navegador:

   - `http://localhost:8000/basicos/`
   - `http://localhost:8000/medios/`
   - `http://localhost:8000/avanzados/`
   - `http://localhost:8000/simulacro/`

6. **Probar.** En `basicos`, copia `soluciones/ejercicio01.php` sobre
   `ejercicios/ejercicio01.php` y pulsa el botón del ejercicio 1: debe salir
   «Conexión correcta».

Si algo falla, mira el apartado [Si no aparece nada o hay un error](#si-no-aparece-nada-o-hay-un-error).

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

## Otros sistemas

Requisitos: PHP 8.2 o posterior con las extensiones `mysqli` y `mysqlnd`, y
MySQL o MariaDB. Los pasos son los mismos que en el inicio rápido, pero el
servidor se arranca con:

```bash
php -S localhost:8000
```

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

**`php` no se reconoce como comando.** La carpeta de PHP no está en el `Path`.
Usa la ruta completa (`& "C:\xampp\php\php.exe" -S localhost:8000`) o añade
`C:\xampp\php` al `Path` y abre una ventana nueva de PowerShell.

**«No se pudo conectar con la base de datos».** Es un mensaje general a
propia: el detalle del error se escribe en la ventana de PowerShell donde
está corriendo `php -S`. Mira esa ventana:

- `Access denied for user 'dwes_app'@'localhost'`: el usuario no existe o la
  clave de `conexion.php` no coincide. Ejecuta el `ALTER USER` del inicio
  rápido con la misma clave que pusiste en `conexion.php`.
- `Unknown database 'centro'`: la base no se llama exactamente `centro` o no
  has importado `sql/centro.sql`.
- `(HY000/2002)`: MySQL no está arrancado en XAMPP, o usa otro puerto (añade
  el puerto como quinto parámetro de `new mysqli(...)`).

**Otros problemas.**

- Comprueba que `mysqli` está habilitada: `php -m` debe listar `mysqli` y
  `mysqlnd`.
- Abre la página desde `http://localhost:8000/...`, no con doble clic en el
  archivo.
- Mira la consola del navegador (`F12`).
- Errores típicos de código: número de `?` distinto al de variables, tipos mal
  escritos en `bind_param`, olvidar `execute()` y usar `"?"` entre comillas.
- Si queda un alumno de prueba sin borrar en `centro`, elimínalo a mano:
  `DELETE FROM matriculas WHERE dni IN ('77777777A', '88888888B');` y
  `DELETE FROM alumnos WHERE dni IN ('77777777A', '88888888B');`.

## Material de origen

Ejercicios basados en la relación de preexamen y en los apuntes del Tema 9
(consultas iniciales y consultas preparadas).
