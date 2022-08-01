<?php
session_start();
if (!isset($_SESSION["username"]) || $_SESSION["username"] != "admin") {
	$_SESSION["msg"] = "Only admin can access this page";
	header("location: ../login.php");
}
?>
