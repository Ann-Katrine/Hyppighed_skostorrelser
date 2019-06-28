<?php


// idea lave 12 om til hvormange der er i bruger
	include "db.php";

	$db = new DB();
	$conn = $db -> getDb();

	// Create GD Image
	$img = imagecreatetruecolor(800, 350);

	// Assign some 
	$black = imagecolorallocate($img, 0, 0, 0);
	$white = imagecolorallocate($img, 255, 255, 255);
	$red = imagecolorallocate($img, 255, 153, 153);
	$text = 'hello';
	$font = 'arial.ttf';

	// Set background colour to white
	imagefill($img, 0, 0, $white);

	$hvor_mange_bruger = $conn -> query("SELECT COUNT(storrelse.storrelse) as num from storrelse");
	$hvor_mange = mysqli_fetch_assoc($hvor_mange_bruger)["num"];

	// antal fra de forskellige skostørrelser
	$x = 40;
	$y = 90;
	for($i = 1; $i < ($hvor_mange + 1); $i++){
		get_sko_value($i, $x, $y, $conn, $black, $red, $img);
		$x += 70;
		$y += 70;
	}

	function get_sko_value($sko, $x, $y, $conn, $bg, $fg, $img) {
		$query = $conn -> query("SELECT COUNT(bruger.skostorrelse) as num from bruger where LEFT (bruger.skostorrelse, 1) = ".$sko);
		$virker = mysqli_fetch_assoc($query)["num"];
		
		imagefilledrectangle($img, $x, 320, $y, 320-($virker * 35), $fg);
		imagerectangle($img, $x, 320, $y, 320-($virker * 35), $bg);
	}

	// Draw x-axis
	$in = 1;
	for($i = 0; $i <= 8; $i += 1){
		if($i < 1)
		{$in += 1;}
		imageline($img, 20, 390-(35 * $in), 790, 390-(35 * $in), $black);
		imagettftext($img, 0, 390-(35 * $in), 790, 390-(35 * $in), $white, $font, $text); //--------------------
		$in += 1;
	}

	// Draw y-axis
	imageline($img, 20, 320, 20, 320-(8*35)-20, $black);

	// Define output header
	header('Content-Type: image/png');

	// Output the png image
	imagepng($img);

	// Destroy GD image
	imagedestroy($img);

?>