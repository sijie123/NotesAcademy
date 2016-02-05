<?php
include "common.php";
if (!isset($_GET['p']) || !isset($_GET['id'])) {
    header("Location: 404.php");
}
$pass = sha1($conn->real_escape_string($_GET['p']));
$id = $conn->real_escape_string($_GET['id']);

$q = $conn->query("SELECT originalname,servername,dl FROM notes WHERE id=$id AND password = '$pass' LIMIT 1");
if ($q->num_rows == 0) {
    header("Location: 401.php");
}
else {
    $r = $q->fetch_assoc();
    $file = "/var/www/html/uploads/".$r['servername'];
    
    if (file_exists($file)) {
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="'.$r['originalname'].'"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($file));
    readfile($file);
    $conn->query("UPDATE notes SET dl = dl + 1 WHERE id = $id;");
    exit;
    }
}
?>