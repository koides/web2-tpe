<?php

    define("DB_NAME", 'musica');
    define("DB_USER", "root");
    define("DB_PASS", "");
    define('DB_CONNECT_STRING', 'mysql:host=localhost; dbname=' .  DB_NAME . '; charset=utf8');
    define('BASE_URL', '//' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']) . '/');

?>