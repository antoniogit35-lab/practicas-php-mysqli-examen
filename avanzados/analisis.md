# Análisis — Ejercicios avanzados

Antes de mirar una solución, intenta responder a las preguntas de cada  
ejercicio. Después, si lo necesitas, lee las pistas.

## Ejercicio 1: Insertar un alumno

### Para pensar

- ¿Cuántas columnas rellenas y cuántos `?` necesitas?
- ¿Qué tipo tiene cada valor y en qué orden aparece en el INSERT?
- ¿Se lee un resultado después de un INSERT?
- ¿Qué propiedad dice cuántas filas se insertaron?

### Pistas

- `INSERT INTO alumnos (dni, nombre, edad) VALUES (?, ?, ?)`.
- `bind_param('ssi', $dni, $nombre, $edad)`: cadena, cadena, entero.
- Un INSERT no devuelve filas: no uses `get_result`.
- `$stmt->affected_rows` justo después de `execute`.

## Ejercicio 2: Actualizar una edad

### Para pensar

- ¿Qué columna cambia y cuál identifica la fila?
- ¿En qué orden aparecen los `?` en el UPDATE?
- ¿Qué valores puede tener `affected_rows` aquí?

### Pistas

- `UPDATE alumnos SET edad = ? WHERE dni = ?`.
- Primero va la edad (entero) y después el DNI (cadena): `'is'`.
- Compara `affected_rows === 1` para el caso normal.
- Cualquier otro valor se trata como «ninguna fila modificada».

## Ejercicio 3: Insertar una matrícula

### Para pensar

- ¿Cuántos parámetros tiene la tabla `matriculas`?
- ¿Qué tipo tiene cada uno?
- ¿Qué letra corresponde a una nota decimal?
- ¿Por qué el alumno y la asignatura deben existir antes?

### Pistas

- Orden de columnas: dni, codigo, anio, nota.
- Cadena de tipos: `'siid'`.
- Las claves foráneas rechazan un DNI o un código que no existan.
- La clave compuesta impide repetir alumno, asignatura y año.

## Ejercicio 4: Actualizar una nota

### Para pensar

- ¿Qué columnas forman la clave primaria de `matriculas`?
- ¿Qué pasaría si olvidas una de ellas en el `WHERE`?
- ¿En qué orden aparecen los `?`?

### Pistas

- `UPDATE matriculas SET nota = ? WHERE dni = ? AND codigo = ? AND anio = ?`.
- Orden: nota (decimal), dni (cadena), codigo (entero), anio (entero): `'dsii'`.
- Sin `anio` en el `WHERE` actualizarías todas las matrículas de esa asignatura.

## Ejercicio 5: Eliminar una matrícula

### Para pensar

- ¿Qué identifica una única matrícula?
- ¿Qué indica `affected_rows` después de un DELETE?
- ¿Qué mensaje corresponde a cada valor?

### Pistas

- `DELETE FROM matriculas WHERE dni = ? AND codigo = ? AND anio = ?`.
- `bind_param('sii', ...)`.
- `affected_rows === 1` es «Matrícula eliminada».
- `affected_rows === 0` es «No encontrada».

## Ejercicio 6: Eliminar una matrícula inexistente

### Para pensar

- ¿Cuántas filas coinciden con año 1999?
- ¿Se produce un error SQL o simplemente no se borra nada?
- ¿Por qué es importante el `WHERE` completo?

### Pistas

- El código es el mismo que en el ejercicio 5; solo cambia el año.
- No borrar nada no es una excepción: `affected_rows` vale 0.

## Ejercicio 7: Actualizar sin cambiar nada

### Para pensar

- ¿Qué valor tiene ya la edad del alumno?
- ¿Qué cuenta `affected_rows` en un UPDATE?
- ¿Cuántas razones distintas hay para que valga 0?

### Pistas

- Normalmente cuenta filas realmente modificadas, no filas encontradas.
- Con 0 puede que el alumno no exista o que ya tuviera ese valor.
- Por eso el mensaje debe mencionar las dos posibilidades.

## Ejercicio 8: DNI duplicado

### Para pensar

- ¿Qué garantiza que no haya dos alumnos con el mismo DNI?
- ¿Qué ocurre en modo estricto cuando se viola esa restricción?
- ¿Qué dato de la excepción te dice que es un duplicado?
- ¿Qué haces con un error que no es un duplicado?

### Pistas

- La clave primaria lanza `mysqli_sql_exception`.
- `$e->getCode()` devuelve el número de error de MySQL; el de entrada duplicada es 1062.
- Captura la excepción alrededor de `execute`.
- Si el código no es 1062, vuelve a lanzarla con `throw $e;`.
