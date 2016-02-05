<?php
include_once "mysql.php";
include_once "common.php";
include_once "check.php";

function setV($var, $enforce) {
    global $conn;
    if (!isset($_POST[$var])) { echo json_encode(array("code"=>1)); die(); }
    $temp = $conn->real_escape_string($_POST[$var]);
    if ($temp == "") { echo json_encode(array("code"=>1)); die(); }
    
    if ($enforce) {
        if ($var == "sch") $var = "school";   //Inconsistencies in database ><
        $q = $conn->query("SELECT type FROM meta WHERE id = '$temp'");
        if ($q->num_rows == 0) { echo json_encode(array("code"=>5)); die(); }
        $r = $q->fetch_assoc();
        if ($r['type'] != $var) { echo json_encode(array("code"=>5)); die(); }
    }
    
    return $temp;
}
			
			
$u = $conn->real_escape_string($_SESSION['user']->userid);


$title = setV("title", false);
$level = setV("level", true);
$sch = setV("sch", true);
$subj = setV("subj", true);


if (isset($_POST['pass'])) {
    $pass = sha1($conn->real_escape_string($_POST['pass']));
}
else {
    $pass = "";
}

if (!isset($_POST['notes'])) { echo json_encode(array("code"=>4)); die(); }

$f = $_POST['notes'];
$file = new File($f, $conn);

if ($file->error == 4) {
    echo json_encode(array("code"=>4)); die();
}
if ($file->error == 5) {
     echo json_encode(array("code"=>5)); die();
}


/*
if (!isset($_POST['subj'])) return 1;
$subj = $_POST['subj'];
foreach($subj as $a) {
    $a = $conn->real_escape_string($a);
}
if (count($subj) == 0) return 1;
*/

$filename = "uploads/" . time() . $file->originalname;

if (!move_uploaded_file($file->servername, $filename)) {
    { echo json_encode(array("code"=>2)); die(); }
}

$hash = hash_file("md5", $filename);
$r = $conn->query("SELECT id FROM notes WHERE hash = '$hash' AND password=''")->num_rows;
if ($r != 0) {
    { echo json_encode(array("code"=>3, "file"=>"$r")); die(); }
}


//Credits
//MS Doc + slsx for catdoc
// http://www.wagner.pp.ru/~vitus/software/catdoc/
// http://stackoverflow.com/questions/5671988/how-to-extract-just-plain-text-from-doc-docx-files-unix

//PDF
// https://gist.github.com/smalot/6183152
// pdftotext


$str = "";

if ($file->getType() == "doc") {
    $str = exec("catdoc '". escapeshellcmd($filename) . "'");
}

if ($file->getType() == "docx") {
    $str = exec("unzip -p '" . escapeshellcmd($filename) . "' word/document.xml | sed -e 's/<\/w:p>/\n/g; s/<[^>]\{1,\}>//g; s/[^[:print:]\n]\{1,\}//g'");
}


if ($file->getType() == "pdf") {
    include "pdfparser.php";
    $parser = new PdfParser();

    $str = $parser->parseFile($filename);
    
    $im = new imagick($filename);
    $im->setImageFormat('jpg');
    $imdata = base64_encode($im);
}

$textarr1 = preg_split("/\s+/", $str);
$textarr = [];
foreach ($textarr1 as $b) {
    if (!in_array($b, $textarr)) {
        $textarr[$b] = 1;
    }
    else {
        $textarr[$b]+=1;
    }
}


$a = $file->originalname;
$b = $filename;
$c = $file->filesize;
$d = $conn->real_ecape_string($file->getType());

if (!isset($im)) $im = "";

$conn->query("INSERT INTO notes VALUES (NULL, '$a', '$b', $c, '$d', $u, 1,1,'$pass', '$hash', NULL, '$title', $level, $sch, $subj, '$im')");
$r = $conn->insert_id;
foreach($textarr as $key=>$value) {
    $key = $conn->real_ecape_string($key);
    $value = $conn->real_escape_string($value);
    $conn->query("INSERT INTO indextable VALUES(NULL, $r, $value, '$key'");
}
echo json_encode(array("code"=>0, "file"=>"$r"));
?>