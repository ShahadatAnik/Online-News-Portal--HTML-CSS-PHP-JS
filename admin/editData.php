<?php
include('adminLogout.php');

include "isAdmin.php";

require "../db/db.php";

$id = $_REQUEST["id"];
$query = "SELECT * from news where id='" . $id . "'";

($result = mysqli_query($db, $query)) or die(mysqli_error());
$row = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html>

	<head>
    <meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<title>Edit News</title>
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" />
	</head>

	<body>
		<div class="form">
			<p><a href="newsDashboard.php">Dashboard</a>
				| <a href="insertData.php">Insert New Record</a>
				| <a href="viewData.php?logout='1'">Logout</a></p>
			<h1>Update Record</h1>
			<?php
$status = "";
if (isset($_POST["new"]) && $_POST["new"] == 1) {
    $id = $_REQUEST["id"];
    $category = mysqli_real_escape_string($db, $_POST["category"]);
    $headline = mysqli_real_escape_string($db, $_POST["headline"]);
    $content = mysqli_real_escape_string($db, $_POST["content"]);
    $updated_datetime = date("Y-m-d H:i:s");
    $update =
        "update news set 
                            category='" . $category . "',
                            headline='" . $headline . "', 
                            content='" . $content . "', 
                            updated_datetime='" . $updated_datetime . "' 
                        where id='" . $id . "'";
    mysqli_query($db, $update) or die(mysqli_error());
    $status = "Record Updated Successfully. </br></br>
                <a href='newsDashboard.php'>View Updated Record</a>";
    echo '<p style="color:#FF0000;">' . $status . "</p>";
}
else {
?>
			<div>
                <form method="post" action="">
					<input type="hidden" name="new" value="1" />
                    <select name="category">
                            <?php
    if ($row["category"] == "Business") {
        echo "<option value='Business' selected>Business</option>";
    }
    else {
        echo "<option value='Business'>Business</option>";
    }
    if ($row["category"] == "Health") {
        echo "<option value='Health' selected>Health</option>";
    }
    else {
        echo "<option value='Health'>Health</option>";
    }
    if ($row["category"] == "Politics") {
        echo "<option value='Politics' selected>Politics</option>";
    }
    else {
        echo "<option value='Politics'>Politics</option>";
    }
    if ($row["category"] == "Sports") {
        echo "<option value='Sports' selected>Sports</option>";
    }
    else {
        echo "<option value='Sports'>Sports</option>";
    }
    if ($row["category"] == "Technology") {
        echo "<option value='Technology' selected>Technology</option>";
    }
    else {
        echo "<option value='Technology'>Technology</option>";
    }
?>
                            
                    </select> 
					<p><input type="text" name="headline" placeholder="Enter Headline" value="<?php echo $row["headline"]; ?>" required /></p>
					<p><input type="text" name="content" placeholder="Enter Content" value="<?php echo $row["content"]; ?>" required /></p>
					
					<p><input name="submit" type="submit" value="Update" /></p>
				</form>
				<?php
}
?>
			</div>
		</div>
	</body>

</html> 