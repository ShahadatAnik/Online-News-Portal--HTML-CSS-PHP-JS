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
		<style>
			.card{
			transition: all 0.2s ease;
			cursor: pointer;
			}

			.card:hover{
			box-shadow: 10px 12px 12px 4px #e9ecef;
			transform: scale(1.01);
			}
		</style>
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
								Welcome <strong class="text-black"><?= $_SESSION["username"]; ?></strong>
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
			<div class="col-md-1"></div>
			<!-- search box -->
			<div class="col-md-10">
			<div class="col-md-12 ">
				<form class="form-inline shadow p-3 bg-body rounded" method="POST" action="index.php">
					<div class="input-group col-md-6">
						<input 
							type="text" 
							class="form-control" 
							placeholder="Search here..." 
							name="keyword" 
							required 
							value="<?= isset($_POST["keyword"]) ? $_POST["keyword"] : ""; ?>"
						/>
						<span class="input-group-btn">
							<button class="btn btn-primary" name="search"><span class="glyphicon glyphicon-search">Search</span></button>
						</span>
					</div>
				</form>
				<br />
				<?php require "db/db.php";
if (isset($_POST["search"])) {
	$keyword = $_POST["keyword"]; ?>
					<div>
						<?php
	($query = mysqli_query(
		$db,
		"SELECT * FROM `news` WHERE `headline` LIKE '%$keyword%' OR `category` LIKE '%$keyword%' ORDER BY `create_datetime` DESC"
	)) or die(mysqli_error());
	while ($row = mysqli_fetch_assoc($query)) { ?>
						<div class="card mb-3 shadow-sm bg-body rounded" style="width: 100%;">
						<a href="news.php?id=<?= $row["id"]; ?>" class="text-decoration-none text-dark">
						<img 
							src="data:image/jpg;charset=utf8;base64,<?= base64_encode($row['headIMG']); ?>" 
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
								<h5 class="card-title"><?= $row["headline"]; ?></h5>
								<p class="card-text"><span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-event-fill" viewBox="0 0 16 16">
                                    <path d="M4 .5a.5.5 0 0 0-1 0V1H2a2 2 0 0 0-2 2v1h16V3a2 2 0 0 0-2-2h-1V.5a.5.5 0 0 0-1 0V1H4V.5zM16 14V5H0v9a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2zm-3.5-7h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5z"/>
                                </svg> <?= substr($row['create_datetime'], 0, 10); ?>
                            </span>
                            <span>&nbsp;&nbsp;</span>
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clock-fill" viewBox="0 0 16 16">
                                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z"/>
                                  </svg> <?= substr($row['create_datetime'], 11, 8); ?>
                            </span>
                            <span>&nbsp;&nbsp;</span>
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-tags-fill" viewBox="0 0 16 16">
                                    <path d="M2 2a1 1 0 0 1 1-1h4.586a1 1 0 0 1 .707.293l7 7a1 1 0 0 1 0 1.414l-4.586 4.586a1 1 0 0 1-1.414 0l-7-7A1 1 0 0 1 2 6.586V2zm3.5 4a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z"/>
                                    <path d="M1.293 7.793A1 1 0 0 1 1 7.086V2a1 1 0 0 0-1 1v4.586a1 1 0 0 0 .293.707l7 7a1 1 0 0 0 1.414 0l.043-.043-7.457-7.457z"/>
                                  </svg> <?= $row['category']; ?>
                            </span></p>
							<?php
		if (isset($_SESSION["username"]) && $_SESSION["username"] == "admin") { ?>
										<a class="btn btn-primary mt-3" href="admin/editData.php?id=<?= $row["id"]; ?>">Edit</a>
										<a class="btn btn-danger mt-3" href="admin/deleteData.php?id=<?= $row["id"]; ?>">Delete</a>
										
								<?php
		}
?>
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
	($query = mysqli_query(
		$db,
		"SELECT * FROM `news` ORDER BY `create_datetime` DESC"
	)) or die(mysqli_error());
	while ($row = mysqli_fetch_assoc($query)) { ?>
						<div class="card mb-3 shadow-sm bg-body rounded" style="width: 100%;">
						<a href="news.php?id=<?= $row["id"]; ?>" class="text-decoration-none text-dark">
							<img 
							src="data:image/jpg;charset=utf8;base64,<?= base64_encode($row['headIMG']); ?>" 
							class="card-img-top" 
							alt="..."
							style="
								object-fit: cover; 
								object-position: center; 
								width: 100%;
								max-height: 300px;
								"
							/>
							<div class="card-body">
								<h5 class="card-title"><?= $row["headline"]; ?></h5>
								<p class="card-text">
									<span>
										<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-event-fill" viewBox="0 0 16 16">
											<path d="M4 .5a.5.5 0 0 0-1 0V1H2a2 2 0 0 0-2 2v1h16V3a2 2 0 0 0-2-2h-1V.5a.5.5 0 0 0-1 0V1H4V.5zM16 14V5H0v9a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2zm-3.5-7h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5z"/>
										</svg> <?= substr($row['create_datetime'], 0, 10); ?>
									</span>
									<span>&nbsp;&nbsp;</span>
									<span>
										<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clock-fill" viewBox="0 0 16 16">
											<path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z"/>
										</svg> <?= substr($row['create_datetime'], 11, 8); ?>
									</span>
									<span>&nbsp;&nbsp;</span>
									<span>
										<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-tags-fill" viewBox="0 0 16 16">
											<path d="M2 2a1 1 0 0 1 1-1h4.586a1 1 0 0 1 .707.293l7 7a1 1 0 0 1 0 1.414l-4.586 4.586a1 1 0 0 1-1.414 0l-7-7A1 1 0 0 1 2 6.586V2zm3.5 4a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z"/>
											<path d="M1.293 7.793A1 1 0 0 1 1 7.086V2a1 1 0 0 0-1 1v4.586a1 1 0 0 0 .293.707l7 7a1 1 0 0 0 1.414 0l.043-.043-7.457-7.457z"/>
										</svg> <?= $row['category']; ?>
									</span>
								</p>
								<?php
		if (isset($_SESSION["username"]) && $_SESSION["username"] == "admin") { ?>
										<a class="btn btn-primary mt-3" href="admin/editData.php?id=<?= $row["id"]; ?>">Edit</a>
										<a class="btn btn-danger mt-3" href="admin/deleteData.php?id=<?= $row["id"]; ?>">Delete</a>
										
								<?php
		}
?>
								</a>
							</div>
						</div>

	<?php
	}
}

?>
				</div>
				<div class="col-md-1"></div>
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