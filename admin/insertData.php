<?php include('adminLogout.php'); ?>
<?php
require "../db/db.php";
include "isAdmin.php";
$status = "";
if (isset($_POST["new"]) && $_POST["new"] == 1) {
	$category = mysqli_real_escape_string($db, $_POST["category"]);
	$headline = mysqli_real_escape_string($db, $_POST["headline"]);
	$content = mysqli_real_escape_string($db, $_POST["content"]);
	$create_datetime = date("Y-m-d H:i:s");
	$updated_datetime = date("Y-m-d H:i:s");

	$ins_query = "insert into news
    (`category`,`headline`,`content`,`create_datetime`, `updated_datetime`)values
    ('$category','$headline','$content','$create_datetime','$updated_datetime')";
	mysqli_query($db, $ins_query) or die(mysql_error());
	$status = "New Record Inserted Successfully.
    </br></br><a href='viewData.php'>View Inserted Record</a>";
}
mysqli_close($db);
?>

<!DOCTYPE html>
<html>

<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<title>News Insert</title>
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" />
	</head>

	<body>
		<div class="form">
			<p><a href="newsDashboard.php">Dashboard</a>
				| <a href="viewData.php">View Records</a>
				| <a href="insertData.php?logout='1'">Logout</a></p>
			<div>
				<h1>Insert New Record</h1>
				<form name="form" method="post" action="">
					<input type="hidden" name="new" value="1" />
                    <select name="category">
                        <option value="Business">Business</option>
                        <option value="Health">Health</option>
                        <option value="Politics">Politics</option>
                        <option value="Sports">Sports</option>
                        <option value="Technology">Technology</option>
                    </select> 
					<p><input type="text" name="headline" placeholder="Enter Headline" required /></p>
					<p><input type="text" name="content" placeholder="Enter Content" required /></p>
					
					<p><input name="submit" type="submit" value="Submit" /></p>
				</form>
				<p style="color:#FF0000;"><?php echo $status; ?></p>
			</div>
		</div>
	</body>

</html>