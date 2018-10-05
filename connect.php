<?php

$connection = null;
try {
$connection = new pdo('mysql:host=localhost;dbname=pdo','root','root',
array(
  PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8',
  PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
));
} catch (PDOException $e) {
  echo "Error In Connection Database:".$e->getmessage();
}



?>

