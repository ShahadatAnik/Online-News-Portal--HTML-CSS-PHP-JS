<?php include "adminLogout.php"; ?>
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
	// $status = "<div id='liveAlertPlaceholder'></div>";
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
		<!-- <link rel="stylesheet" href="../css/bootstrap.min.css" /> -->
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">



	</head>

	<body>
		<div class="container-fluid">
			<nav class="navbar navbar-expand-lg bg-light">
				<div class="container-fluid ">
					<a class="navbar-brand border border-dark border-3 rounded px-2" href="../index.php"><b>Online News Portal</b></a>
					<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
						<span class="navbar-toggler-icon"></span>
					</button>
					<div class="collapse navbar-collapse" id="navbarNavDropdown">
						<ul class="navbar-nav ml-auto">
							<!-- <li class="nav-item">
									<a class="nav-link active" aria-current="page" href="#">Home</a>
								</li> -->
							<?php
if (isset($_SESSION["username"])) {
	if ($_SESSION["username"] == "admin") { ?>
							<li class="nav-item dropdown ">
								<a class="nav-link dropdown-toggle " href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
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
								<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
									Welcome <strong class="text-black"><?php echo $_SESSION["username"]; ?></strong>
								</a>
								<ul class="dropdown-menu bg-danger" aria-labelledby="navbarDropdownMenuLink">
									<li><a class="dropdown-item bg-danger text-white fw-bold text-center" href="insertData.php?logout='1'">logout</a></li>
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
			<form class="row g-3 m-2 border-dark border-3 rounded px-2" name="form" method="post" action="" enctype="multipart/form-data">
				<input type="hidden" name="new" value="1" />
				<div class="col-md-6">
					<label for="inputState" class="form-label">News Category</label>
					<select id="inputState" class="form-select"  name="category">
						<option value="Business" selected>Business</option>
						<option value="Health">Health</option>
						<option value="Politics">Politics</option>
						<option value="Sports">Sports</option>
						<option value="Technology">Technology</option>
					</select>
				</div>
				<div class="col-md-6">
					<label for="formFile" class="form-label">News Heading Image</label>
					<input class="form-control" type="file" id="formFile" name="headIMG" required>
				</div>
				<div class="col-md-12 mb-3">
					<label for="exampleFormControlInput1" class="form-label">News Heading</label>
					<input type="text" class="form-control" id="exampleFormControlInput1" name="headline" placeholder="Enter Headline" required>
				</div>
				<div class="col-md-12 mb-3">
					<label for="exampleFormControlTextarea1" class="form-label">News Content</label>
					<textarea class="form-control" id="exampleFormControlTextarea1" rows="5" name="content" placeholder="Enter Content" required></textarea>
				</div>
				<div class="col-12">
					<button id="liveAlertBtn" name="submit" type="submit" value="Submit" class="btn btn-primary">Submit</button>
				</div>
			</form>
			<p style="color:#FF0000;"><?php echo $status; ?></p>
			<!-- <div id="liveAlertPlaceholder"></div> -->

		</div>
		<script>
			const alertPlaceholder = document.getElementById('liveAlertPlaceholder')

			const alert = (message, type) => {
			const wrapper = document.createElement('div')
			wrapper.innerHTML = [
				`<div class="alert alert-${type} alert-dismissible" role="alert">`,
				`   <div>${message}</div>`,
				'   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>',
				'</div>'
			].join('')

			alertPlaceholder.append(wrapper)
			}

			const alertTrigger = document.getElementById('liveAlertBtn')
			if (alertTrigger) {
			alertTrigger.addEventListener('click', () => {
				alert('Data Has been inserted successfully.', 'success')
			})
			}

		</script>
		<script src="../js/jquery-3.5.1.slim.min.js" type="text/javascript"></script>
		<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js" integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous"></script>

	</body>


</html>