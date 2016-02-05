<?php
include "mysql.php";
include "common.php";


if(!isset($_GET['code'])) die();

$c = $conn->real_escape_string($_GET['code']);

$conn->query("UPDATE users SET verifyemail = 1 WHERE code='$c'");
header("Location: login.php?verify=true");
?>