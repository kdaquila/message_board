<?php
    define('DB_USER', 'root');
    define('DB_PASS', 'root');
    define('DB_HOST','localhost');
    define('DB_NAME','forum2');
    $dbc = @mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME) OR 
          die('Could not connect to MySQL: ' . mysqli_connect_error() );
    mysqli_set_charset($dbc, 'utf8');