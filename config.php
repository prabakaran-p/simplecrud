<?php
$dbserver = 'localhost';
$dbname = 'myfirstdatabase';
$dbuser = 'root';
$dbpass = '';
try{
	$conn = new PDO("mysql:host=$dbserver;dbname=$dbname", $dbuser, $dbpass);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
	echo "Connection Failed:".$e->getMessage();
}


?>