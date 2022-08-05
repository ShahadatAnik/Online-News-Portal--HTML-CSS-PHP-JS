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

	$fileName = $_FILES["headIMG"]["name"];
	$tempName = $_FILES["headIMG"]["tmp_name"];
	$folder = "../image/" . $fileName;

	$ins_query = "insert into news
    (`category`,`headline`,`content`,`create_datetime`, `updated_datetime`, `headIMG`) values
    ('$category','$headline','$content','$create_datetime','$updated_datetime','$fileName')";
	mysqli_query($db, $ins_query) or die(mysql_error());
	$status = "New Record Inserted Successfully.
    </br></br><a href='viewData.php'>View Inserted Record</a>";

	if (move_uploaded_file($tempName, $folder)) {
		$status = "Image uploaded successfully";
	}
	else {
		$status = "Failed to upload image";
	}
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
		<link rel="stylesheet" href="../css/bootstrap.min.css" />
	</head>

	<body>
		<div class="form">
			<a href="newsDashboard.php">View Records</a>
				| <a href="insertData.php?logout='1'">Logout</a></p>
			<div>
				<h1>Insert New Record</h1>
				<form name="form" method="post" action="" enctype="multipart/form-data">
					<input type="hidden" name="new" value="1" />
                    <select name="category">
                        <option value="Business">Business</option>
                        <option value="Health">Health</option>
                        <option value="Politics">Politics</option>
                        <option value="Sports">Sports</option>
                        <option value="Technology">Technology</option>
                    </select> 
					<p><input type="file" name="headIMG" required/></p>
					<p><input type="text" name="headline" placeholder="Enter Headline" required /></p>
					<p><input type="text" name="content" placeholder="Enter Content" required /></p>
					<p><input name="submit" type="submit" value="Submit" /></p>
				</form>
				<p style="color:#FF0000;"><?php echo $status; ?></p>
			</div>
		</div>
	</body>
	<script src="../jquery-3.5.1.slim.min.js"/>
		<script src="../popper.min.js"/>
		<script src="../js/bootstrap.min.js"/>

</html>