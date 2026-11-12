# Análisis — Ejercicios medios

Antes de mirar una solución, intenta responder a las preguntas de cada  
ejercicio. Después, si lo necesitas, lee las pistas.

## Ejercicio 1: Buscar por edad máxima

### Para pensar

- ¿Qué valor cambia de una búsqueda a otra?
- ¿Cuántos `?` necesita la consulta y de qué tipo es el valor?
- ¿Qué método lee el resultado de un SELECT preparado?
- ¿Cómo ordenas por dos columnas?

### Pistas

- `WHERE edad < ?` y `ORDER BY edad, nombre`.
- `bind_param('i', $limite)`.
- El orden es: `prepare`, `bind_param`, `execute`, `get_result`.
- Con `get_result` puedes usar `num_rows` y `fetch_assoc`.
- Cierra con `free()` en el resultado y `close()` en la sentencia.

## Ejercicio 2: Buscar por dos edades

### Para pensar

- ¿Cuántos marcadores necesitas?
- ¿Cuántas letras debe tener la cadena de tipos?
- ¿En qué orden se vinculan las variables?

### Pistas

- `WHERE edad = ? OR edad = ?`.
- `bind_param('ii', $edad1, $edad2)`.
- El primer `?` usa la primera variable y el segundo `?` la segunda.
- Añade `ORDER BY edad` para que el orden no dependa del servidor.

## Ejercicio 3: Buscar parte de un nombre

### Para pensar

- ¿Qué operador SQL busca texto parcial?
- ¿Dónde se escriben los comodines `%`?
- ¿Qué tipo tiene el patrón?
- ¿Cómo sabes si no hubo ninguna coincidencia si no usas `get_result`?

### Pistas

- `WHERE nombre LIKE ?`.
- `$patron = '%' . $texto . '%';` y `bind_param('s', $patron)`.
- No pongas el `?` entre comillas.
- `bind_result` necesita una variable por columna, en el mismo orden.
- Cuenta las filas dentro del `while ($stmt->fetch() === true)`.

## Ejercicio 4: Filtrar matrículas por nota

### Para pensar

- ¿Qué tres tablas intervienen?
- ¿Qué tipo de dato es `nota` y qué letra de `bind_param` le corresponde?
- ¿Cómo ordenas de mayor a menor?
- ¿Qué pasa con las notas `NULL` al comparar?

### Pistas

- Parte de `matriculas` y únela con `alumnos` y `asignaturas`.
- `WHERE m.nota >= ?` y `ORDER BY m.nota DESC`.
- `nota` es DECIMAL, así que usa `d`.
- Una comparación con `NULL` nunca es verdadera: esas filas no salen.
- Usa alias de columna para `alumno` y `asignatura`.

## Ejercicio 5: Consultar por año

### Para pensar

- ¿Qué valor es variable y de qué tipo?
- ¿Cómo distingues una nota `NULL` de un `0`?
- ¿Qué debe ver el usuario si no hay nota?

### Pistas

- `WHERE m.anio = ?` con `bind_param('i', $anio)`.
- Con `get_result`, una nota `NULL` llega como `null` en PHP.
- Compara con `=== null`. No uses `empty()`, porque un `0` es una nota válida.
- Para probar el caso `NULL`, ejecuta `sql/extra_nota_null.sql`.

## Ejercicio 6: Reutilizar una sentencia

### Para pensar

- ¿Qué parte se repite y qué parte cambia?
- ¿Cuántas veces hay que llamar a `prepare`?
- ¿Qué relación hay entre `bind_param` y la variable?

### Pistas

- Prepara una vez, fuera del `foreach`.
- `bind_param` conserva una referencia a la variable `$edad`.
- Usa `$edad` como variable del `foreach` para que cambie el valor vinculado.
- Ejecuta y consume todas las filas antes de la siguiente vuelta.

## Ejercicio 7: Contar con store_result

### Para pensar

- ¿Por qué `num_rows` no sirve antes de leer el resultado con `bind_result`?
- ¿Qué método almacena las filas para poder contarlas?
- ¿Qué se libera al terminar?

### Pistas

- El orden es: `execute`, `store_result`, `num_rows`, `bind_result`, `fetch`.
- No mezcles `store_result` con `get_result`.
- Termina con `free_result()` y `close()`.

## Ejercicio 8: El texto es un dato

### Para pensar

- ¿Qué haría esa cadena si se concatenara en el SQL?
- ¿Qué busca realmente la consulta preparada?
- ¿Un resultado vacío significa que algo falló?

### Pistas

- La cadena contiene comillas simples: delimítala con comillas dobles en PHP.
- Con `bind_param('s', $nombre)` el texto viaja separado del SQL.
- Se busca literalmente un alumno con ese nombre, y no existe.
- Cero coincidencias es un resultado correcto.
