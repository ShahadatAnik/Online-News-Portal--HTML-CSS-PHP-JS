<?php?>
<?php
require "adminLogout.php";
require "isAdmin.php";
require "../db/db.php";
$status = "";
$statusMsg = "";
if (isset($_POST["submit"])) {
	$category = mysqli_real_escape_string($db, $_POST["category"]);
	$headline = mysqli_real_escape_string($db, $_POST["headline"]);
	$content = mysqli_real_escape_string($db, $_POST["content"]);
	$datetime = date("Y-m-d H:i:s");

	if (!empty($_FILES["headIMG"]["name"])) {
		// Get file info 
		$fileName = basename($_FILES["headIMG"]["name"]);
		$fileType = pathinfo($fileName, PATHINFO_EXTENSION);

		// Allow certain file formats 
		$allowTypes = array('jpg', 'png', 'jpeg', 'gif');
		if (in_array($fileType, $allowTypes)) {
			$image = $_FILES['headIMG']['tmp_name'];
			$imgContent = addslashes(file_get_contents($image));

			// Insert image content into database 
			$ins_query = "insert into news
				(`category`,`headline`,`content`,`create_datetime`, `updated_datetime`, `headIMG`) values
				('$category','$headline','$content','$datetime','$datetime','$imgContent')";
			mysqli_query($db, $ins_query) or die(mysql_error());
			$status = "<div class='alert alert-success text-center' role='alert'>
				New Record Inserted Successfully. <a href='newsDashboard.php' class='alert-link'>Click to view record.</a>
						</div>";

		}
		else {
			$statusMsg = "<div class='alert alert-danger text-center' role='alert'>
							Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload.
						</div>";
		}
	}
	else {
		$statusMsg = "<div class='alert alert-danger text-center' role='alert'>
						Please select an image file to upload.
					</div>";
	}

}


mysqli_close($db);
?>

<!DOCTYPE html>
<html>

<head>
	<title>Insert Data</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>News Insert</title>
	<!-- <link rel="stylesheet" href="../css/bootstrap.min.css" /> -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
</head>

<body>
	<div class="container-fluid">
		<nav class="navbar navbar-expand-lg bg-light">
			<div class="container-fluid">
				<a class="navbar-brand border border-dark border-3 rounded px-2" href="../index.php"><b>Online News
						Portal</b></a>
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse"
					data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false"
					aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarNavDropdown">
					<ul class="navbar-nav ml-auto">
						<?php
if (isset($_SESSION["username"])) {
	if ($_SESSION["username"] == "admin") { ?>
						<li class="nav-item dropdown ">
							<a class="nav-link dropdown-toggle " href="#" id="navbarDropdown" role="button"
								data-bs-toggle="dropdown" aria-expanded="false">
								Dashboard
							</a>
							<ul class="dropdown-menu text-center" aria-labelledby="navbarDropdown">
								<li><a class="dropdown-item" href="newsDashboard.php">View News</a></li>
								<li><a class="dropdown-item" href="insertData.php">Insert News</a></li>
							</ul>
						</li>
						<?php
	}
}
if (isset($_SESSION["username"])) { ?>

						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
								data-bs-toggle="dropdown" aria-expanded="false">
								Welcome <strong class="text-black">
									<?php echo $_SESSION["username"]; ?>
								</strong>
							</a>
							<ul class="dropdown-menu bg-danger" aria-labelledby="navbarDropdownMenuLink">
								<li><a class="dropdown-item bg-danger text-white fw-bold text-center"
										href="insertData.php?logout='1'">logout</a></li>
							</ul>
						</li>
						<?php
}
else { ?>
						<li class="nav-item">
							<a class="nav-link text-primary" href="../login.php">Login</a>
						</li>

						<?php
}
?>
				</div>
			</div>
		</nav>
		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-8">
				<h1 class="text-center m-2 mb-4 p-1 border border-dark border-3 border-top-0 border-end-0 rounded">
					Insert News</h1>
			</div>
			<div class="col-md-2"></div>
		</div>
		<div class="row mb-3">
			<div class="col-md-2"></div>
			<div class="col-md-8 shadow-lg bg-body rounded">
				<form class="row g-3 m-2 border-dark border-3 rounded px-2" name="form" method="post" action=""
					enctype="multipart/form-data">
					<div class="col-md-6">
						<label for="inputState" class="form-label fw-bold">News Category</label>
						<select id="inputState" class="form-select" name="category">
							<option value="Business" selected>Business</option>
							<option value="Health">Health</option>
							<option value="Politics">Politics</option>
							<option value="Sports">Sports</option>
							<option value="Technology">Technology</option>
						</select>
					</div>
					<div class="col-md-6">
						<label for="formFile" class="form-label fw-bold">News Heading Image</label>
						<input class="form-control" type="file" id="formFile" name="headIMG" required>
					</div>
					<div class="col-md-12 mb-3">
						<label for="exampleFormControlInput1" class="form-label fw-bold">News Heading</label>
						<input type="text" class="form-control" id="exampleFormControlInput1" name="headline"
							placeholder="Enter Headline" required>
					</div>
					<div class="col-md-12 mb-3">
						<label for="exampleFormControlTextarea1" class="form-label fw-bold">News Content</label>
						<textarea class="form-control" id="exampleFormControlTextarea1" rows="12" name="content"
							placeholder="Enter Content" required></textarea>
					</div>
					<div class="col-12 text-center">
						<button id="liveAlertBtn" name="submit" type="submit" value="Submit"
							class="btn btn-primary btn-lg">Submit</button>
					</div>
				</form>
				<?php if ($status != "") {
	echo $status;
	$status = "";
}
if ($statusMsg != "") {
	echo $statusMsg;
	$statusMsg = "";
}
?>
			</div>
			<div class="col-md-2"></div>
		</div>


	</div>
	<script>
		if (window.history.replaceState) {
			window.history.replaceState(null, null, window.location.href);
		}
	</script>
	<script src="../js/jquery-3.5.1.slim.min.js" type="text/javascript"></script>
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js"
		integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk"
		crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js"
		integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK"
		crossorigin="anonymous"></script>

</body>


</html>