<?php

require "adminLogout.php";

require "isAdmin.php";

require "../db/db.php";
?>

<!DOCTYPE html>
<html lang="en">

	<head>
		<title>Dashboard</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<title>News Dashboard</title>
		<link rel="stylesheet" href="../css/bootstrap.min.css" />
	</head>

	<body>
		<div class="container-fluid ">
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
								<li><a class="dropdown-item bg-danger text-white fw-bold text-center" href="newsDashboard.php?logout='1'">logout</a></li>
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
					<h1 class="text-center m-2 mb-4 p-1 border border-dark border-3 border-top-0 border-end-0 rounded">View News</h1>
				</div>
				<div class="col-md-2"></div>
		</div>
		<div class="row">
			<div class="col-md-1"></div>
			<div class="col-md-10 table-responsive-sm" >
			<table class="table table-lg  table-striped  align-middle" >
				<thead class="table-dark">
					<tr>
						<th class="text-center border"><strong>S.No</strong></th>
						<th class="text-center border"><strong>Category</strong></th>
						<th class="text-center border"><strong>Image</strong></th>
						<th class="text-center border"><strong>Headline</strong></th>
						<th class="text-center border"><strong>Created</strong></th>
						<th class="text-center border"><strong>Updated</strong></th>
						<th class="text-center border" colspan="2"><strong>Action</strong></th>
						
					</tr>
				</thead>
				<tbody>
					<?php
$count = 1;
$sel_query = "Select * from news ORDER BY updated_datetime desc;";
$result = mysqli_query($db, $sel_query);
while ($row = mysqli_fetch_assoc($result)) {
?>
					<tr>
						<td ><?php echo $count; ?></td>
						<td ><?php echo $row["category"]; ?></td>
						<td ><img style="width:128px;height:128px" src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['headIMG']); ?>" /></td>
						<td ><?php echo $row["headline"]; ?></td>
						<td ><?php echo $row["create_datetime"]; ?></td>
						<td ><?php echo $row["updated_datetime"]; ?></td>
						
						<td >
							<a class="btn btn-primary" href="editData.php?id=<?= $row["id"]; ?>">Edit</a>
							
						</td>
						<td >
							<a class="btn btn-danger" href="deleteData.php?id=<?= $row["id"]; ?>">Delete</a>
						</td>
					</tr>
					<?php $count++;
}?>
				</tbody>
			</table>
		</div>
			</div>
			<div class="col-md-1"></div>
		</div>
			
		</div>
		<script src="../js/jquery-3.5.1.slim.min.js" type="text/javascript"></script>
		<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
	</body>

</html>