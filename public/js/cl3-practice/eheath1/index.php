<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Ehealth</title>
</head>
<body>

	<div style="margin:0 auto; width:500px;">
		<h2>Book an appointment</h2>

		<form action="appointment.php" method="POST">
			<input type="text" placeholder="Enter Name" name="name" required="True"><br><br>
			<input type="text" name="email" placeholder="Enter Email address" required="True"><br><br>
			<input type="number" name="ph_number" placeholder="Enter Phone Number" required="True"><br><br>
			<input type="date" name="appointment_date" placeholder="Enter The Date" required="True"><br><br>
			<button type="submit" >Submit</button>
		</form>
		<br>
		<a href="admin.php"> View Admin</a>	
	</div>
	
</body>
</html>