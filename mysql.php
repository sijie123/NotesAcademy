<?php 
$dbhost = 'localhost';
$dbuser = 'notesacademy';
$dbpass = 'XZ8CW52svKhrZFZY';
$dbname = 'notesacademy';

$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

if ($conn == false) {
	header("Location: error.php");
	die();
}
?>
