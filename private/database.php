<?php

require_once('db_credentials.php');

/* Functions to connect to local database (mysql) */

function db_connect() {
    $connection = mysqli_connect(SERVER, USER, PASSWORD, PROJECT);
    confirm_db_connect();
    return $connection;
}

function db_disconnect($connection) {
    if(isset($connection)) {
        mysqli_close($connection);
    }
}

// This function is used to create a legal SQL string that you can use in an SQL statement. 
// The given string is encoded to an escaped SQL string, 
// taking into account the current character set of the connection.
function db_escape($connection, $string) {
    return mysqli_real_escape_string($connection, $string);
}

function confirm_db_connect() {
    if(mysqli_connect_errno()) {
        $msg = "Database connection failed: ";
        $msg .= mysqli_connect_error();
        $msg .= " (" . mysqli_connect_errno() . ")";
        exit($msg);
    }
}

function confirm_result_set($result_set) {
    if (!$result_set) {
        exit("Database query failed.");
    }
}

?>