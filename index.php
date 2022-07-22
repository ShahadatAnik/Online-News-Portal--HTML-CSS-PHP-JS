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
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" />
	</head>

	<body>
		<div class="header">
			<h2>Home Page</h2>
		</div>
		<div class="content">
			<!-- notification message -->
			<?php if (isset($_SESSION["success"])): ?>
			<div class="error success">
				<h3>
					<?php
     echo $_SESSION["success"];
     unset($_SESSION["success"]);
     ?>
				</h3>
			</div>
			<?php endif; ?>

			<!-- logged in user information -->
			<?php if (isset($_SESSION["username"])) { ?>
			<p>Welcome <strong><?php echo $_SESSION["username"]; ?></strong></p>
			<p> <a href="index.php?logout='1'" style="color: red;">logout</a> </p>
			<?php } else { ?>
			<button class="button button-danger"><a href="login.php" class="text-decoration-none"><strong>Login</strong></a></button>
			<?php } ?>
		</div>
		<div>
			<?php if (isset($_SESSION["username"])) {
					if ($_SESSION["username"] == "admin") { ?>
							<button class="button button-danger"><a href="admin/newsDashboard.php" class="text-decoration-none"><strong>Dashboard</strong></a></button>
							<?php }
				} ?>
		</div>
	</body>

</html>