<?php
// Copia este archivo como conexion.php y pon tu clave real.
// conexion.php está en .gitignore: no lo subas al repositorio.

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$db = new mysqli('localhost', 'dwes_app', 'CAMBIA_ESTA_CLAVE', 'centro');
$db->set_charset('utf8mb4');
