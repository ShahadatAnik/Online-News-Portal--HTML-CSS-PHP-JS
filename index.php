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
				<nav class="navbar navbar-expand-lg bg-light">
					<div class="container-fluid">
						<a class="navbar-brand border border-dark border-3 rounded px-2" href="index.php"><b>Online News Portal</b></a>
						<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
							<span class="navbar-toggler-icon"></span>
						</button>
						<div class="collapse navbar-collapse" id="navbarNavDropdown">
							<ul class="navbar-nav">
								<!-- <li class="nav-item">
									<a class="nav-link active" aria-current="page" href="#">Home</a>
								</li> -->
								<li class="nav-item">
									<a class="nav-link" href="#">Features</a>
								</li>
								<?php if (isset($_SESSION["username"])) {
	if ($_SESSION["username"] == "admin") { ?>
									<li class="nav-item dropdown">
										<a class="nav-link dropdown-toggle" href="admin/newsDashboard.php" role="button" data-bs-toggle="dropdown" aria-expanded="false">
										Dashboard
										</a>
										<ul class="dropdown-menu">
											<li><a class="dropdown-item" href="#">Home</a></li>
											<li><a class="dropdown-item" href="#">Another action</a></li>
											<li><a class="dropdown-item" href="#">Something else here</a></li>
										</ul>
									</li>
								<?php
	}
}?>
							</ul>
						</div>
					</div>
				</nav>
		<div class="content">
			<!-- logged in user information -->
			<?php if (isset($_SESSION["username"])) { ?>
			<p>Welcome <strong><?php echo $_SESSION["username"]; ?></strong></p>
			<p> <a href="index.php?logout='1'" style="color: red;">logout</a> </p>
			<?php
}
else { ?>
				<button class="button button-danger"><a href="login.php" class="text-decoration-none"><strong>Login</strong></a></button>
			<?php
}?>
		</div>
		<script src="jquery-3.5.1.slim.min.js"></script>
		<script src="popper.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
	</body>
</html>