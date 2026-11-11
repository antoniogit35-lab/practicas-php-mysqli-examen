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
│   └── centro.sql
├── guia/
├── basicos/
├── medios/
├── avanzados/
└── simulacro/
```

> Las carpetas se irán añadiendo por fases. Cada nivel tendrá `index.php`,
> `analisis.md`, `ejercicios/` y `soluciones/`.

## Base de datos `centro`

| Tabla | Columnas | Clave |
|---|---|---|
| alumnos | dni, nombre, edad | dni |
| asignaturas | codigo, nombre, creditos, trimestre | codigo |
| matriculas | dni, codigo, anio, nota | dni + codigo + anio |

Datos iniciales: 4 alumnos, 3 asignaturas y 5 matrículas.

## Niveles

| Nivel | Contenido |
|---|---|
| basicos | Conexión, SELECT fijo, `fetch_assoc`, tabla HTML, `ORDER BY` y `LIMIT` |
| medios | Consultas preparadas de lectura: `bind_param`, `get_result`, `LIKE`, JOIN, NULL |
| avanzados | INSERT, UPDATE y DELETE preparados, `affected_rows`, clave compuesta |
| simulacro | Réplica del preexamen: informe con LEFT JOIN, alta completa, código inseguro |

## Cómo ponerlo en marcha

Requisitos: PHP 8.2 o posterior con la extensión `mysqli`, y MySQL o MariaDB.

1. Importa `sql/centro.sql` con tu cliente SQL (una sola vez).
2. Crea el usuario `dwes_app` con permisos sobre `centro` (hay un ejemplo
   comentado al final del script).
3. Copia `conexion.example.php` como `conexion.php` y pon tu clave.
4. Arranca un servidor PHP desde la raíz del repo:

   ```bash
   php -S localhost:8000
   ```

5. Abre `http://localhost:8000` en el navegador.

## Cómo trabajar los ejercicios

1. Lee el enunciado.
2. Piensa cómo resolverlo.
3. Consulta `analisis.md` si te atascas.
4. Intenta resolverlo por tu cuenta.
5. Compara tu resultado con el esperado.
6. Mira la solución solo después de haberlo intentado.

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
- Mira el log de errores de PHP.
- Errores típicos: número de `?` distinto al de variables, tipos mal escritos
  en `bind_param`, olvidar `execute()` y usar `"?"` entre comillas.

## Material de origen

Ejercicios basados en la relación de preexamen y en los apuntes del Tema 9
(consultas iniciales y consultas preparadas).
