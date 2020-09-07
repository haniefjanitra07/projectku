<?php  
session_start();

require_once 'connect.php';

$id_delete = strip_tags(trim($conn->real_escape_string($_GET["id"])));

$sql_delete = "SELECT * FROM users WHERE id = '$id_delete'";
$query_delete = $conn->query($sql_delete);
// var_dump($query_delete->num_rows);
// die;
if ($query_delete->num_rows > 0) {
	$sql_delete2 = "DELETE FROM users WHERE id = '$id_delete' ";
	$query_delete = $conn->query($sql_delete2);
	$_SESSION["success"] = "#".$id_delete . "  deleted";
}else{
	$_SESSION["error"] = "Id is not found on database";
}
	header('location: index.php');


?>