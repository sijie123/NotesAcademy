<?php
include_once "mysql.php";
include_once "common.php";

function setV($var) {
    global $conn;
    if (!isset($_POST[$var])) { echo json_encode(array("code"=>1)); die(); }
    $temp = $conn->real_escape_string($_POST[$var]);
    if ($temp == "") { echo json_encode(array("code"=>1)); die(); }
    
    if ($var == "user") {
        $q = $conn->query("SELECT id FROM users WHERE username = '$temp'");
        if ($q->num_rows != 0) { echo json_encode(array("code"=>2)); die(); }
    }
    
    if ($var == "sch" || $var == "level") {
        if ($var == "sch") $var = "school";   //Inconsistencies in database ><
        $q = $conn->query("SELECT type FROM meta WHERE id = $temp");
        if ($q->num_rows == 0) { echo json_encode(array("code"=>5)); die(); }
        $r = $q->fetch_assoc();
        if ($r['type'] != $var) { echo json_encode(array("code"=>5)); die(); }
    }
    
    return $temp;
}
			
$name = setV("name");
$level = setV("level");
$sch = setV("sch");
$email = setV("email");
$user = setV("user");
$pass = setV("pass");
$pass2 = setV("pass2");

if ($pass != $pass2) {echo json_encode(array("code"=>3)); die();}
$hash = password_hash($pass, PASSWORD_BCRYPT);

$code = sha1(time() . rand() . "saltingnotesacademy");

$q = $conn->query("INSERT INTO users VALUES (NULL, '$name', '$email', '$sch', '$level', '$user', '$hash', 0, '$code')");

if ($conn->error != "") {
    echo json_encode(array("code"=>4)); die();
}

include "mail.php";

require 'vendor/autoload.php';
use Mailgun\Mailgun;

# Instantiate the client.
$mgClient = new Mailgun('key-213f48adefd728cc9b8e9fef93db1293');
$domain = "sandboxa292c28717dd4593ac738e7fadcd0de6.mailgun.org";

# Make the call to the client.
$result = $mgClient->sendMessage($domain, array(
    'from'    => 'NotesAcademy <noreply@notesacademy.org>',
    'to'      => $email,
    'subject' => 'Welcome to NotesAcademy!',
    'html'    => $str
));


echo json_encode(array("code"=>0)); die();
?>