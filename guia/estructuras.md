# Guía de estructuras — MySQLi (Tema 9 DWES)

Resumen para consultar durante los ejercicios. Todos los ejemplos usan la
interfaz orientada a objetos y la variable `$db` creada en `conexion.php`.

## 1. Conexión

```php
<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$db = new mysqli('localhost', 'dwes_app', 'CLAVE', 'centro');
$db->set_charset('utf8mb4');
```

- `MYSQLI_REPORT_STRICT`: un fallo SQL lanza `mysqli_sql_exception`.
- `utf8mb4` en la conexión evita problemas con tildes.
- Usa una cuenta propia de la aplicación, nunca `root` sin contraseña.

## 2. Tres objetos distintos

| Clase | Representa | Métodos habituales |
|---|---|---|
| `mysqli` | La conexión | `query`, `prepare`, `set_charset`, `close` |
| `mysqli_result` | Las filas de un SELECT | `fetch_assoc`, `fetch_array`, `free` |
| `mysqli_stmt` | Una sentencia preparada | `bind_param`, `execute`, `bind_result`, `fetch` |

`new` crea un objeto y `->` accede a sus métodos o propiedades.

## 3. Manejo de errores

```php
try {
    require 'conexion.php';
    // ... consultas ...
    $db->close();
} catch (mysqli_sql_exception $e) {
    error_log($e->getMessage());
    http_response_code(500);
    echo 'No se pudo completar la operación.';
}
```

Registra el detalle con `error_log` y muestra al visitante un mensaje general.
Nunca enseñes credenciales ni errores internos.

## 4. SQL fijo con `query`

Úsalo solo cuando la consulta **no lleva valores variables**.

```php
$resultado = $db->query('SELECT nombre, edad FROM alumnos ORDER BY nombre');
echo 'Total: ' . $resultado->num_rows;

while ($fila = $resultado->fetch_assoc()) {
    $n = htmlspecialchars($fila['nombre'], ENT_QUOTES, 'UTF-8');
    $e = (int) $fila['edad'];
    echo "$n: $e<br>";
}
$resultado->free();
$db->close();
```

| Método | Claves del array |
|---|---|
| `fetch_assoc()` | Nombres de columna: `$fila['nombre']` |
| `fetch_row()` | Posiciones desde 0: `$fila[0]` |
| `fetch_array(MYSQLI_ASSOC)` | Nombres de columna |
| `fetch_array(MYSQLI_NUM)` | Posiciones |
| `fetch_array()` | Ambas (`MYSQLI_BOTH`) |

Cada llamada consume **una** fila. No encadenes varias esperando la misma.

### Qué devuelve `query`

| Operación | Resultado |
|---|---|
| SELECT | Objeto `mysqli_result`, aunque no haya filas |
| INSERT, UPDATE, DELETE | `true`; después comprueba `affected_rows` |
| Error con modo estricto | Lanza `mysqli_sql_exception` |

Cero filas **no es un error**: es un resultado válido.

```php
if ($r->num_rows === 0) {
    echo 'No hay alumnos con esa condición.';
}
```

## 5. Consulta preparada: el ciclo

| Paso | Acción |
|---|---|
| 1 | `prepare`: devuelve un `mysqli_stmt` |
| 2 | `bind_param`: vincula variables a los `?` |
| 3 | `execute`: usa los valores actuales |
| 4 | Leer (solo SELECT): `get_result` o `bind_result` + `fetch` |
| 5 | Cerrar: `free()` el resultado y `close()` la sentencia |

```php
$stmt = $db->prepare('SELECT nombre, edad FROM alumnos WHERE edad < ?');
$limite = 22;
$stmt->bind_param('i', $limite);
$stmt->execute();
```

### Tipos de `bind_param`

| Letra | Tipo | Ejemplo |
|---|---|---|
| `i` | Entero | `$edad = 21` |
| `d` | Decimal (coma flotante) | `$nota = 7.5` |
| `s` | Cadena | `$dni = '22222222B'` |
| `b` | Binario por bloques | Ampliación |

Regla de oro: **nº de `?` = nº de letras = nº de variables**, y en el mismo orden.

```php
// INSERT INTO alumnos (dni, nombre, edad) VALUES (?, ?, ?)
$stmt->bind_param('ssi', $dni, $nombre, $edad);
```

### Qué se puede parametrizar

- Un `?` representa un **valor**: edad, DNI, nombre, nota.
- No representa una tabla, una columna ni `ASC`/`DESC`.
- `WHERE nombre = "?"` busca un signo de interrogación literal. No pongas
  comillas.
- Para `IN` con varios valores necesitas un `?` por cada valor.

## 6. Leer resultados de una preparada

### Opción A: `get_result` (requiere mysqlnd)

```php
$r = $stmt->get_result();
echo 'Coincidencias: ' . $r->num_rows;
while ($fila = $r->fetch_assoc()) {
    echo htmlspecialchars($fila['nombre'], ENT_QUOTES, 'UTF-8') . '<br>';
}
$r->free();
$stmt->close();
```

### Opción B: `bind_result` + `fetch`

```php
$stmt->bind_result($nombre, $edad);   // una variable por columna, en orden
while ($stmt->fetch() === true) {
    echo htmlspecialchars($nombre, ENT_QUOTES, 'UTF-8') . ": $edad<br>";
}
$stmt->close();
```

`fetch` devuelve `true` si hay fila, `null` al agotarse y `false` ante error.

### Opción C: contar con `store_result`

```php
$stmt->execute();
$stmt->store_result();
echo $stmt->num_rows;          // disponible antes de recorrer
$stmt->bind_result($dni);
while ($stmt->fetch() === true) { /* ... */ }
$stmt->free_result();
$stmt->close();
```

No mezcles `get_result` y `store_result` en la misma ejecución.

`bind_param` **envía** entradas; `bind_result` **recibe** columnas. No son
intercambiables.

## 7. Patrones frecuentes

### Dos parámetros

```php
$stmt = $db->prepare('SELECT nombre FROM alumnos WHERE edad = ? OR edad = ?');
$stmt->bind_param('ii', $edad1, $edad2);
```

### LIKE: los comodines van en la variable PHP

```php
$stmt = $db->prepare('SELECT nombre FROM alumnos WHERE nombre LIKE ?');
$patron = '%' . $texto . '%';
$stmt->bind_param('s', $patron);
```

Si el usuario escribe `%` o `_`, siguen siendo comodines de LIKE.

### JOIN con alias

```sql
SELECT a.nombre AS alumno, s.nombre AS asignatura, m.anio, m.nota
FROM matriculas AS m
JOIN alumnos AS a ON a.dni = m.dni
JOIN asignaturas AS s ON s.codigo = m.codigo
WHERE m.nota >= ?
ORDER BY m.nota DESC;
```

Los alias evitan dos columnas con el mismo nombre en el array asociativo.

### LEFT JOIN: incluir alumnos sin matrículas

```sql
SELECT a.nombre, s.nombre AS asignatura, m.anio, m.nota
FROM alumnos AS a
LEFT JOIN matriculas AS m ON m.dni = a.dni
LEFT JOIN asignaturas AS s ON s.codigo = m.codigo
WHERE a.dni = ?
ORDER BY m.anio DESC, s.nombre;
```

Con LEFT JOIN, las columnas de matrícula y asignatura llegan como `NULL`
cuando no hay coincidencias.

### NULL en la salida

```php
$nota = $fila['nota'] === null ? 'Pendiente' : $fila['nota'];
```

`NULL` no es `0` ni `""`. En SQL se comprueba con `IS NULL` / `IS NOT NULL`.

### Reutilizar una sentencia

```php
$stmt = $db->prepare('SELECT nombre FROM alumnos WHERE edad = ?');
$edad = 0;
$stmt->bind_param('i', $edad);
foreach ([24, 25] as $edad) {
    $stmt->execute();
    $stmt->bind_result($nombre);
    while ($stmt->fetch() === true) { /* ... */ }
}
$stmt->close();
```

`bind_param` conserva referencias a las variables. Consume todas las filas antes
de volver a ejecutar.

## 8. Altas, modificaciones y bajas

Lee `affected_rows` **justo después** de `execute`.

```php
// INSERT
$stmt = $db->prepare('INSERT INTO alumnos (dni, nombre, edad) VALUES (?, ?, ?)');
$stmt->bind_param('ssi', $dni, $nombre, $edad);
$stmt->execute();
echo 'Insertados: ' . $stmt->affected_rows;

// UPDATE
$stmt = $db->prepare('UPDATE alumnos SET edad = ? WHERE dni = ?');
$stmt->bind_param('is', $edad, $dni);

// DELETE con clave compuesta
$stmt = $db->prepare('DELETE FROM matriculas WHERE dni = ? AND codigo = ? AND anio = ?');
$stmt->bind_param('sii', $dni, $codigo, $anio);
```

| Operación | `affected_rows` |
|---|---|
| INSERT | Filas insertadas |
| UPDATE | Filas **realmente modificadas** |
| DELETE | Filas borradas |

Un UPDATE con `0` puede significar «no existe» o «ya tenía ese valor».
Para contar filas de un SELECT se usa `num_rows`, no `affected_rows`.

### Propiedades útiles de `mysqli_stmt`

| Propiedad | Significado |
|---|---|
| `param_count` | Nº de marcadores de entrada |
| `field_count` | Nº de columnas del resultado |
| `affected_rows` | Filas afectadas por INSERT/UPDATE/DELETE |
| `num_rows` | Filas almacenadas tras `store_result` |
| `insert_id` | Valor AUTO_INCREMENT generado |

`alumnos` usa el DNI como clave, así que no genera `insert_id`.

### Claves duplicadas

- La clave primaria impide dos filas con el mismo DNI.
- Consultar antes no lo garantiza: otra petición puede insertar entre medias.
- La restricción de la base de datos es la garantía final. Captura la excepción y
  muestra un mensaje comprensible.

## 9. Seguridad

### Por qué no concatenar

```php
// MAL: el dato se mezcla con la sintaxis SQL
$nombre = $_GET['nombre'] ?? '';
$sql = "SELECT dni, nombre FROM alumnos WHERE nombre = '$nombre'";
$r = $db->query($sql);
```

Una comilla en el dato altera la consulta, incluso con un nombre legítimo
como «O'Brien».

```php
// BIEN: SQL y valor viajan separados
$nombre = $_GET['nombre'] ?? '';
$stmt = $db->prepare('SELECT dni, nombre FROM alumnos WHERE nombre = ?');
$stmt->bind_param('s', $nombre);
$stmt->execute();
$r = $stmt->get_result();
while ($fila = $r->fetch_assoc()) {
    echo htmlspecialchars($fila['nombre'], ENT_QUOTES, 'UTF-8');
}
```

### Tres defensas distintas

| Defensa | Protege de |
|---|---|
| Consulta preparada | Inyección SQL |
| `htmlspecialchars` | Inyección en el HTML (XSS) |
| Validación (`filter_var`) | Datos con formato o rango incorrectos |

Ninguna sustituye a las otras.

### Validar un entero

```php
$limite = filter_var($entrada, FILTER_VALIDATE_INT,
    ['options' => ['min_range' => 0, 'max_range' => 120]]);
if ($limite === false) { exit('Edad no válida.'); }
```

No uses `if (!$limite)`: `0` es un valor válido.

## 10. Errores típicos

| Síntoma | Causa probable |
|---|---|
| Error al ejecutar | Nº de `?` distinto al de variables o letras |
| Datos mal guardados | Orden de tipos incorrecto en `bind_param` |
| Busca un `?` literal | `?` entre comillas en el SQL |
| LIKE no encuentra nada | `%` puestos en el SQL en lugar de en la variable |
| No sale ningún resultado | Falta `execute()` o no se recorre el resultado |
| Fila saltada | Varios `fetch` seguidos que consumen filas |
| `0` en UPDATE | El valor ya era el mismo, o la clave no existe |
| Faltan alumnos en el informe | JOIN en vez de LEFT JOIN |
| Texto con tildes roto | Falta `utf8mb4` o `meta charset` en el HTML |

## 11. Lista de comprobación

- [ ] Cuento los `?`.
- [ ] Reviso la cadena de tipos.
- [ ] Compruebo el orden de las variables.
- [ ] Ejecuto la sentencia.
- [ ] Recorro todas las filas.
- [ ] Uso `affected_rows` en operaciones de escritura.
- [ ] Escapo con `htmlspecialchars` lo que muestro.
- [ ] Cierro resultado, sentencia y conexión.
