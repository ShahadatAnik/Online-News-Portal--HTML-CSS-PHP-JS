<?php
require "../db/db.php";
include "isAdmin.php";

$id = $_REQUEST['id'];

$query = "DELETE FROM news WHERE id=$id";
$result = mysqli_query($db, $query) or die(mysqli_error());

$query = "DELETE FROM comments WHERE newsId=$id";
$result = mysqli_query($db, $query) or die(mysqli_error());

header("Location: newsDashboard.php");

?>