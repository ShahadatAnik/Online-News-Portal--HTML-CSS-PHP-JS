<?php
session_start();
// if (!isset($_SESSION["username"])) {
// 	$_SESSION["msg"] = "You must log in first";
// 	header("location: login.php");
// }
if (isset($_GET["logout"])) {
	session_destroy();
	unset($_SESSION["username"]);
	header("location: login.php");
}
?>
<!DOCTYPE html>
<html lang="en">

	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<title>Home</title>
		<link rel="stylesheet" href="css/bootstrap.min.css" />
	</head>

	<body>
	<div class="container-fluid ">
		<nav class="navbar navbar-expand-lg bg-light">
			<div class="container-fluid ">
				<a class="navbar-brand border border-dark border-3 rounded px-2" href="index.php"><b>Online News Portal</b></a>
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
								<li><a class="dropdown-item" href="admin/newsDashboard.php">View News</a></li>
								<li><a class="dropdown-item" href="admin/insertData.php">Insert News</a></li>
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
								<li><a class="dropdown-item bg-danger text-white fw-bold text-center" href="index.php?logout='1'">logout</a></li>
							</ul>
						</li>
						<?php
}
else { ?>
						<li class="nav-item">
							<a class="btn btn-outline-primary fw-bold" class="nav-link text-primary" href="login.php">Login</a>
						</li>

						<?php
}
?>

				</div>
			</div>
		</nav>
		<div class="row">
			<div class="col-md-2">
				<h2>Category</h2>
			</div>
			<!-- search box -->
			<div class="col-md-10">
			<div class="col-md-12">
				<form class="form-inline" method="POST" action="index.php">
					<div class="input-group col-md-6">
						<input 
							type="text" 
							class="form-control" 
							placeholder="Search here..." 
							name="keyword" 
							required 
							value="<?php echo isset($_POST["keyword"]) ? $_POST["keyword"] : ""; ?>"
						/>
						<span class="input-group-btn">
							<button class="btn btn-primary" name="search"><span class="glyphicon glyphicon-search">Search</span></button>
						</span>
					</div>
				</form>
				<br />
				<?php if (isset($_POST["search"])) {
	$keyword = $_POST["keyword"]; ?>
					<div>
						<?php
	require "db/db.php";
	($query = mysqli_query(
		$db,
		"SELECT * FROM `news` WHERE `headline` LIKE '%$keyword%' ORDER BY `headline`"
	)) or die(mysqli_error());
	while ($row = mysqli_fetch_assoc($query)) { ?>
						<div class="card mb-3" style="width: 100%;">
						<a href="news.php?id=<?php echo $row["id"]; ?>" class="text-decoration-none text-dark">
						<img 
							src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['headIMG']); ?>" 
							class="card-img-top" 
							alt="..."
							style="
								object-fit: none; 
								object-position: center; 
								width: 100%;
								max-height: 200px;
								margin-bottom: 1rem;"
							/>
							<div class="card-body">
								<h5 class="card-title"><?php echo $row["headline"]; ?></h5>
								<p class="card-text"><?php echo substr($row["content"], 0, 100); ?>...</p>
								</a>
							</div>
						</div>
						<?php
	}
?>
					</div>
					<?php
}
else { ?>
	<div>
						<?php
	require "db/db.php";
	($query = mysqli_query(
		$db,
		"SELECT * FROM `news` ORDER BY `headline`"
	)) or die(mysqli_error());
	while ($row = mysqli_fetch_assoc($query)) { ?>
						<div class="card mb-3" style="width: 100%;">
						<a href="news.php?id=<?php echo $row["id"]; ?>" class="text-decoration-none text-dark">
							<img 
							src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['headIMG']); ?>" 
							class="card-img-top" 
							alt="..."
							style="
								object-fit: none; 
								object-position: center; 
								width: 100%;
								max-height: 200px;
								margin-bottom: 1rem;"
							/>
							<div class="card-body">
								<h5 class="card-title"><?php echo $row["headline"]; ?></h5>
								<p class="card-text"><?php echo substr($row["content"], 0, 100); ?>...</p>
								</a>
							</div>
						</div>

	<?php
	}
}

?>
				</div>
			</div>
		</div>
	</div>
	<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>
		<script src="js/jquery-3.5.1.slim.min.js" type="text/javascript"></script>
		<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
	</body>

</html>