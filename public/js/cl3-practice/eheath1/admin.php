<?php

$hostname = "localhost";
$username = "root";
$password = "";
$dbname = "ehealth";

$conn = new mysqli($hostname , $username , $password , $dbname);

if( $conn->connect_error)
{
	die("Connection Failed". $conn->connect_error );
}

$result = $conn->query("SELECT * FROM appointments");

$appointments = [];

if ($result->num_rows > 0)
{
	while ($row = $result->fetch_assoc())  {

		$appointments[]=$row; 
		
	}


}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Ehealth Admin</title>
	<style type="text/css">
		table tr {
			padding: 3px;
		}
		table td,th{
			padding: 5px;
			padding-right: 15px;
			text-align: center;
		}

		.container {
			margin :0 auto;
			width :500px;
		}
	</style>
</head>
<body>

	<div class="container">
	<h2> ADMIN PANEL</h2>
	
	<table>
		<tr>
			<th>Name</th>
			<th>Email</th>
			<th>Phone Number</th>
			<th>Date</th>
		</tr>
		<?php foreach($appointments as $app):  ?>
		<tr>
			<td><?= $app["name"]; ?></td>
			<td><?= $app["email"]; ?></td>
			<td><?= $app["ph_number"]; ?></td>
			<td><?= $app["appointment_date"]; ?></td>
		</tr>
	<?php endforeach; ?>
	</table>
	</div>
</body>
</html>
