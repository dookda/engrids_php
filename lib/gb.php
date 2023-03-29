<?php
$hostname_db = "localhost";
$database_db = "gb";
$username_db = "postgres";
$password_db = "pgis@CGI@2015";

    function conndb() {
        global $conn;
        global $hostname_db;
        global $username_db;
        global $password_db;
        global $database_db;
        $conn = pg_connect("host=$hostname_db user=$username_db password=$password_db dbname=$database_db") or die("Can't Connect Server");

		pg_query("SET client_encoding = 'utf-8'");
    }

    function closedb() {
      global $conn;
      pg_close($conn);
    }
?>
