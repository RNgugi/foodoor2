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



if (isset($_POST["name"]))
	{
		$name = $_POST["name"];
		$email = $_POST["email"];
		$ph_number = $_POST["ph_number"];
		$appointment_date = $_POST["appointment_date"];



	$stmt = $conn->prepare("INSERT INTO appointments (name,email,ph_number,appointment_date) VALUES (?,?,?,?)");
	$stmt->bind_param("ssds" , $name , $email , $ph_number , $appointment_date);

	$stmt->execute();

	

	$stmt->close();
	$conn->close();

	header("Location: index.php");

	} 

 ?>
