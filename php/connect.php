<?php

$dsn = "mysql:host=localhost;dbname=dmm-crm";  /* Data Source Name */
$username = "root"; $pass = "";
$options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
$dbh = new PDO($dsn, $username, $pass, $options) or die("Pb de connexion !");

?>