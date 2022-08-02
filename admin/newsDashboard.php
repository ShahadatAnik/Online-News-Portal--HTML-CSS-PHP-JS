<?php

include('adminLogout.php');

include "isAdmin.php";

require "../db/db.php";
?>

<!DOCTYPE html>
<html lang="en">

	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<title>News Dashboard</title>
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" />
	</head>

	<body>
		<div class="container">
			<div class = "row">
			<h1>Welcome to Dashboard </h1>
			<a href="../index.php">Home</a>
					<a href="insertData.php">Insert New Record</a>
					<a href="newsDashboard.php?logout='1'">Logout</a>
		</div>
		<div class="table-responsive">
			<h2>View Records</h2>
			<table class="table table-lg align-middle">
				<thead class="table-dark">
					<tr>
						<th><strong>S.No</strong></th>
						<th><strong>Category</strong></th>
						<th><strong>Headline</strong></th>
						<th><strong>Created</strong></th>
						<th><strong>Updated</strong></th>
						<th><strong>Edit</strong></th>
						<th><strong>Delete</strong></th>
					</tr>
				</thead>
				<tbody>
					<?php
$count = 1;
$sel_query = "Select * from news ORDER BY category asc;";
$result = mysqli_query($db, $sel_query);
while ($row = mysqli_fetch_assoc($result)) {
?>
					<tr>
						<td align="center"><?php echo $count; ?></td>
						<td align="center"><?php echo $row["category"]; ?></td>
						<td align="center"><?php echo $row["headline"]; ?></td>
						<td align="center"><?php echo $row["create_datetime"]; ?></td>
						<td align="center"><?php echo $row["updated_datetime"]; ?></td>
						
						<td align="center">
							<a href="editData.php?id=<?= $row["id"]; ?>">Edit</a>
						</td>
						<td align="center">
							<a href="deleteData.php?id=<?= $row["id"]; ?>">Delete</a>
						</td>
					</tr>
					<?php $count++;
}?>
				</tbody>
			</table>
		</div>

		</div>
		
	</body>

</html>