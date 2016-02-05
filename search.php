<?php
include "mysql.php";

if (($userq = $conn->real_escape_string($_POST['q'])) == "") {
	$res = array();
	$query = "SELECT id, exttype, title,preview FROM notes WHERE approved = 1 ORDER BY dl DESC LIMIT 30";
	$q = $conn->query($query);
	if ($q->num_rows != 0) {
		while ($r = $q->fetch_assoc()) {
			$res[] = $r; 
		}
		echo json_encode($res);
		die();
	}
	else {
		echo json_encode("No Notes Here");
		die();
	}
}

$globalcount = 0;
$query = "SELECT id,dl FROM notes WHERE title LIKE '%$userq%' ";
$scorearr = array();

$qarr = array();

function verify($var) {
	if ($var != "0") return true;
	else return false;
}

function addToArr($key, $word) {
	global $qarr;
	if (verify($word)) {
		$qarr[] = "$key = $word";
		return $word;
	}
	else return "";
}

function addScore($id,$score) {
	global $scorearr;
	if (!isset($scorearr[$id])) {
		$scorearr[$id] = $score;
	}
	else {
		$scorearr[$id] += $score;
	}
}

$usersch = addToArr("sch",$conn->real_escape_string($_POST['sch']));
$userlvl = addToArr("lvl",$conn->real_escape_string($_POST['lvl']));
$usersubj = addToArr("subj",$conn->real_escape_string($_POST['subj']));
if (count($qarr) != 0) {
	$t = implode(" AND ", $qarr);
	$query .= " AND " .$t;
}

$q = $conn->query($query);
if ($q->num_rows != 0) {
	while ($r = $q->fetch_assoc()) {
		$id = $r['id'];
		$occ = $r['dl'];
		addScore($id, 5+$occ/200);
	}
}
$qarr = array();
addToArr("notes.sch",$usersch);
addToArr("notes.lvl",$userlvl);
addToArr("notes.subj",$usersubj);
if (count($qarr) != 0) {
	$t = implode(" AND ", $qarr);
}
	
$warr = explode(" ", $userq);
foreach ($warr as $x) {
	$query = "SELECT indextable.notesid, indextable.occurrence
		  FROM indextable INNER JOIN notes ON indextable.notesid = notes.id
		  WHERE indextable.word = '$x' ";
	if (isset($t)) {$query .= " AND " . $t; }
	
	$q = $conn->query($query);
	if ($q->num_rows != 0) {
		
	
		while ($r = $q->fetch_assoc()) {
			$id = $r['indextable.notesid'];
			$occ = $r['indextable.occurrence'];
			addScore($id, 1 + $occ/100);
		}
	}
}

$i = 0;
arsort($scorearr);
$res = array();
foreach($scorearr as $v=>$k) {
	if ($i == 30 || $k <= 0) break;
	$q = $conn->query("SELECT id, exttype, title,preview FROM notes WHERE approved = 1 AND id = $v");
	$r = $q->fetch_assoc();
	$res[] = $r; 
	$i++;
}
if (empty($res)) {
	echo "No Notes Here";
	die();
}
echo json_encode($res);

?>