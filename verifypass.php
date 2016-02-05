<?php
include "common.php";
if (!isset($_POST['pass']) || !isset($_POST['id'])) {
    echo json_encode("ERR");
    die();
}
$pass = sha1($conn->real_escape_string($_POST['pass']));
$id = $conn->real_escape_string($_POST['id']);

$q = $conn->query("SELECT servername FROM notes WHERE id=$id AND password = '$pass' LIMIT 1");
if ($q->num_rows == 0) {
    echo json_encode("ERR");
}
else {
    $r = $q->fetch_assoc();
    echo json_encode($r['servername']);
}
?>