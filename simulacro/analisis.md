# Análisis — Simulacro

Este nivel se parece al examen: intenta resolverlo sin consultar la guía ni  
los niveles anteriores. Usa las preguntas para comprobar tu razonamiento y las  
pistas solo si te quedas bloqueado.

## Ejercicio 1: Informe de un alumno

### Para pensar

- ¿Qué tabla debe ser la primera de la consulta para no perder alumnos?
- ¿Qué tipo de JOIN conserva filas sin coincidencia?
- ¿Qué valores llegan en las columnas de matrícula cuando no hay ninguna?
- ¿Cómo ordenas por año de más reciente a más antiguo?

### Pistas

- Parte de `alumnos`, no de `matriculas`.
- Dos `LEFT JOIN`: uno a `matriculas` y otro a `asignaturas`.
- El filtro por DNI va en el `WHERE` y es el único parámetro.
- `ORDER BY m.anio DESC, s.nombre`.

## Ejercicio 2: Alta segura completa

### Para pensar

- ¿Por qué el alumno debe insertarse antes que la matrícula?
- ¿Cuántas sentencias preparadas necesitas?
- ¿Qué debe ver el usuario si algo falla y qué debe quedar en el log?
- ¿Qué pasaría si el segundo INSERT falla cuando el primero ya funcionó?

### Pistas

- Dos `prepare` distintos, cada uno con su `bind_param`.
- Los tipos son `ssi` para el alumno y `siid` para la matrícula.
- Una sola captura de `mysqli_sql_exception` cubre las dos operaciones.
- Construye el mensaje de éxito y muéstralo solo si no ha habido error.

## Ejercicio 3: Corregir código inseguro

### Para pensar

- ¿Qué ocurre si el nombre contiene una comilla simple?
- ¿Qué parte del SQL controla el usuario en el fragmento original?
- ¿Qué protege la sentencia preparada y qué protege `htmlspecialchars`?
- ¿Qué pasa si el parámetro llega como un array en lugar de texto?

### Pistas

- El valor viaja separado de la plantilla SQL: `WHERE nombre = ?`.
- `bind_param('s', $nombre)`.
- Escapa con `htmlspecialchars` el nombre que sale de la base de datos.
- Comprueba con `is_string` antes de usar el valor recibido.

## Ejercicio 4: Informe de un alumno sin matrículas

### Para pensar

- ¿Cuántas filas devuelve el informe para un alumno sin matrículas?
- ¿Cómo distingues «el alumno no existe» de «no tiene matrículas»?
- ¿Qué columna te permite detectar que no hay matrícula?

### Pistas

- Sin alumno: 0 filas. Con alumno sin matrículas: 1 fila con `NULL` en año.
- Comprueba `=== null` sobre el año de la primera fila.
- El nombre del alumno aparece en ambos casos, así que muéstralo siempre.

## Lista de comprobación final

- ¿Cuento los `?` y reviso la cadena de tipos?
- ¿Las variables van en el orden de los `?`?
- ¿He ejecutado la sentencia y recorrido todas las filas?
- ¿He escapado la salida con `htmlspecialchars`?
- ¿He cerrado resultado, sentencia y conexión?
- ¿He tratado errores sin enseñar datos internos?
