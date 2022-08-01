<?php include('adminLogout.php'); ?>
<?php
require "../db/db.php";
include "isAdmin.php";
?>
<!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8">
		<title>View Records</title>
		<link rel="stylesheet" href="css/style.css" />
	</head>

	<body>
		<div class="form">
			<p><a href="../index.php">Home</a>
				| <a href="insertData.php">Insert New Record</a>
				| <a href="viewData.php?logout='1'">Logout</a></p>
			<h2>View Records</h2>
			<table width="100%" border="1" style="border-collapse:collapse;">
				<thead>
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
$result = mysqli_query($con, $sel_query);
while ($row = mysqli_fetch_assoc($result)) {
?>
					<tr>
						<td align="center"><?php echo $count; ?></td>
						<td align="center"><?php echo $row["category"]; ?></td>
						<td align="center"><?php echo $row["headline"]; ?></td>
						<td align="center"><?php echo $row["create_datetime"]; ?></td>
						<td align="center"><?php echo $row["updated_datetime"]; ?></td>
						
						<td align="center">
							<a href="editData.php?id=<?php echo $row["id"]; ?>">Edit</a>
						</td>
						<td align="center">
							<a href="deleteData.php?id=<?php echo $row["id"]; ?>">Delete</a>
						</td>
					</tr>
					<?php $count++;
}?>
				</tbody>
			</table>
		</div>
	</body>

</html>