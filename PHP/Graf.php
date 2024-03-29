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

	// text
	$text = "-1";
	$size = "36";
	$font = 'C:/wamp64/www/Hyppighed_skostorrelser/PHP/arial.ttf';

	// Set background colour to white
	imagefill($img, 0, 0, $white);

	$hvor_mange_bruger = $conn -> query("SELECT COUNT(storrelse.storrelse) as num from storrelse");
	$hvor_mange = mysqli_fetch_assoc($hvor_mange_bruger)["num"];

	// antal fra de forskellige skostørrelser
	$x = 40;
	$y = 90;
	$tal = 55;
	for($i = 1; $i < ($hvor_mange + 1); $i++){
		get_sko_value($i, $x, $y, $conn, $black, $red, $img, $font, $size++, $tal);
		$x += 70;
		$y += 70;
		$tal += 70;
	}

	function get_sko_value($sko, $x, $y, $conn, $bg, $fg, $img, $font, $size, $tal) {
		$query = $conn -> query("SELECT COUNT(bruger.skostorrelse) as num from bruger where LEFT (bruger.skostorrelse, 1) = ".$sko);
		$virker = mysqli_fetch_assoc($query)["num"];
		
		imagefilledrectangle($img, $x, 320, $y, 320-($virker * 35), $fg);
		imagerectangle($img, $x, 320, $y, 320-($virker * 35), $bg);
		imagettftext($img, 13, 0, $tal, 340, $bg, $font, ($size)); // text hen ad x-aksen
	}

	// Draw x-axis
	$in = 1;
	for($i = 0; $i <= 8; $i += 1){
		if($i < 1)
		{$in += 1;}
		imageline($img, 20, 390-(35 * $in), 790, 390-(35 * $in), $black);
		imagettftext($img, 13, 0, 3, 394-(35 * $in), $black, $font, ($text += 1)); // text ned ad y-aksen
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