<?php

session_start();

if ($_POST['user'] == "sijie123" && $_POST['pass'] == "linsijie") {
	$_SESSION['user'] = 'sijie123';
}

?>