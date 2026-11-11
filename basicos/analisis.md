# Análisis — Ejercicios básicos

Antes de mirar una solución, intenta responder a las preguntas de cada  
ejercicio. Después, si lo necesitas, lee las pistas.

## Ejercicio 1: Comprobar la conexión

### Para pensar

- ¿Qué cuatro datos necesita `new mysqli(...)`?
- ¿Qué pasa si falla la conexión y el modo estricto está activado?
- ¿Qué información no debe ver el visitante?
- ¿Dónde guardarás el detalle del error?

### Pistas

- Activa el modo estricto con `mysqli_report` antes de conectar.
- Configura `utf8mb4` con `set_charset`.
- Envuelve la conexión en `try` y captura `mysqli_sql_exception`.
- Registra el error con `error_log` y muestra un mensaje general.
- Para probar el `catch`, cambia la clave en `conexion.php` y ejecuta de nuevo.

## Ejercicio 2: Listar alumnos

### Para pensar

- ¿Qué columnas necesitas y cómo las ordenas?
- ¿Qué devuelve `query` con un SELECT?
- ¿Cómo sabes cuántas filas hay?
- ¿Cómo recorres todas las filas?
- ¿Qué texto necesita escaparse antes de mostrarse en HTML?

### Pistas

- La consulta es fija, así que puedes usar `query`.
- `num_rows` del resultado da el total.
- `fetch_assoc` dentro de un `while` recorre las filas.
- Usa `htmlspecialchars` con el nombre.
- Termina con `free()` en el resultado y `close()` en la conexión.

## Ejercicio 3: Ordenar y limitar

### Para pensar

- ¿Por qué columna ordenas y en qué sentido?
- ¿Cuántas filas quieres?
- ¿Se resuelve en PHP o en SQL?
- ¿Qué pasaría sin `ORDER BY`?

### Pistas

- `ORDER BY edad DESC` pone primero a los mayores.
- `LIMIT 2` corta el resultado.
- Selecciona solo `nombre` y `edad`, no `*`.
- El recorrido es igual que en el ejercicio 2.

## Ejercicio 4: Listar asignaturas

### Para pensar

- ¿Qué tabla y qué columnas necesitas?
- ¿Por qué columna ordenas y en qué sentido?
- ¿Qué tipo de dato es `creditos`?

### Pistas

- La tabla es `asignaturas`.
- `ORDER BY creditos DESC` ordena de más a menos.
- Convierte `creditos` con `(int)` al mostrarlo.
- Escapa el nombre con `htmlspecialchars`.

## Ejercicio 5: Consulta sin coincidencias

### Para pensar

- ¿Un resultado con 0 filas es un error?
- ¿Qué propiedad te dice cuántas filas hay?
- ¿Qué debe ver el usuario si no hay datos?

### Pistas

- Cero filas es un resultado correcto, no una excepción.
- Comprueba `num_rows === 0` antes de recorrer.
- Muestra el mensaje y no dibujes la tabla.
- Aun así, libera el resultado y cierra la conexión.

## Ejercicio 6: Relacionar datos con JOIN

### Para pensar

- ¿Qué tabla contiene la relación entre alumnos y asignaturas?
- ¿Con qué columnas se unen las tres tablas?
- ¿Qué problema aparece si `alumnos` y `asignaturas` tienen una columna `nombre`?
- ¿Cómo se ordenan varias columnas?

### Pistas

- Parte de `matriculas` y únela con `alumnos` (por `dni`) y con
  `asignaturas` (por `codigo`).
- Usa alias de tabla (`a`, `s`, `m`) y de columna (`alumno`, `asignatura`).
- En el array asociativo las claves son los alias del SELECT.
- `ORDER BY a.nombre, m.anio, s.nombre`.
