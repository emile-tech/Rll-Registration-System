<?php

/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'rll_registration_system');

/* Attempt to connect to MySQL database */
$mysqli = new mysqli('localhost', 'root', '', 'rll_registration_system');

// Check connection
if ($mysqli->connect_error !== NULL) {
    die("ERROR: Could not connect. " . $mysqli->connect_error);
} else {
    echo "Successful";
}
