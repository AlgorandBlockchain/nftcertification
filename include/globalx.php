<?php

    $host ="localhost";
    $user="root";
    $password="123";
    $database="dbmyskills";
    $dbh1 = mysql_connect($host,$user,$password) or die("Koneksi server gagal");
    mysql_select_db($database);

?>
