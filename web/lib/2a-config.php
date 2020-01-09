<?php
/* [DATABASE SETTINGS] */
// ! CHANGE THESE TO YOUR OWN !
define('DB_HOST', 'proj-mysql.uopnet.plymouth.ac.uk');
define('DB_NAME', 'isad251_sdaniel');
define('DB_CHARSET', 'utf8');
define('DB_USER', 'ISAD251_SDaniel');
define('DB_PASSWORD', 'ISAD251_22201615');

/* [MUTE NOTIFICATIONS] */
error_reporting(E_ALL & ~E_NOTICE);

/* [PATH] */
// Manually define the absolute path if you get path problems
define('PATH_LIB', __DIR__ . DIRECTORY_SEPARATOR);

/* [START SESSION] */
session_start();
if (!is_array($_SESSION['cart'])) { $_SESSION['cart'] = []; }
?>