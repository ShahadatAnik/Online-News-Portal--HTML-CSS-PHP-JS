<?php
session_start();
if (!isset($_SESSION["username"]) || $_SESSION["username"] != "admin") {
	$_SESSION["msg"] = "Only admin can access this page";
	header("location: ../login.php");
}
if (isset($_GET["logout"])) {
	session_destroy();
	unset($_SESSION["username"]);
	header("location: ../login.php");
}
?>