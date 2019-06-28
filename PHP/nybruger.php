<?php
include 'db.php';

if($_SERVER["REQUEST_METHOD"] == "POST")
{
	$db = new DB();
	
	$conn = $db -> getDb();
	
	$name = mysqli_real_escape_string($conn, $_POST['navn']);
	$mail = mysqli_real_escape_string($conn, $_POST['mail']);
	$alder = mysqli_real_escape_string($conn, $_POST['alder']);
	$storrelse = mysqli_real_escape_string($conn, $_POST['storrelse']);
	
	$select = $conn -> query("select * from bruger where Email = '$mail'");
	
	if(mysqli_num_rows($select) > 0){
		echo "Du er grøn og er allerede oprettet";
		 return;
	}
	
	$query = mysqli_query($conn, "INSERT INTO bruger (Navn, Email, Skostorrelse, Brugerage) VALUES ('$name', '$mail', '$storrelse', '$alder')");
	
	
}
?>