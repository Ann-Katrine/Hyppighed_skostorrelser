<?php
	include "db.php";
	
	$db = new DB();
	$conn = $db -> getDb();
	

	$query = mysqli_query($conn, "select * from bruger INNER JOIN storrelse ON bruger.skostorrelse = storrelse.storrelseId;");

	//var_dump($query);

	$kek = array();
	for($i = 0; $i < mysqli_num_rows($query); $i++){
		$kek[] = $query -> fetch_assoc();
		//var_dump($query -> fetch_assoc());
	}
	echo json_encode($kek);
	
?>