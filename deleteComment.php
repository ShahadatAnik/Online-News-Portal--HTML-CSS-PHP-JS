<?php
require "db/db.php";

$cmnt_id = $_REQUEST['cmnt_id'];
$id = $_REQUEST['id'];
$query = "DELETE FROM comments WHERE id=$cmnt_id";

$result = mysqli_query($db, $query) or die(mysqli_error());
header("Location: news.php?id=" . $id);

?>