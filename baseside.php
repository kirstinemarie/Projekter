<?php session_start(); ?> <!-- session begynder her -->
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Hemmeligheder</title>
<link rel="stylesheet" href="logind_stylesheet.css">
</head>

<body>

<?php
	if(empty($_SESSION['uid'])){ //tjekker de gemlte bruger id, hvor den ikke kan finde noget i dette tilfælde 
		echo 'Du skal være logget ind, for at få adgang til din profil';
	}
	else {
		echo '<h1> Make lemonade '.$_SESSION['username']. '</h1>'; // session er med til at gemme bruger navnen og echo det som en personlig besked 
		echo '<p><br>HEMMELIG LEMONADE OPSKRIFT <br><br>
		ca. 1 liter<br>

		2,5 dl sukker <br>
		2 dl vand til siruppen<br>
		3 dl friskpresset citronsaft <br>
		8 dl vand til at fortynde med<br><br><br>

		Lav siruppen ved at varme sukker og vand i en lille gryde til al sukkeret er opløst.<br>
		Pres imens citronerne.<br>
		Hæld sirup og citronsaft i en kande og tilsæt vand efter smag. Ca. 8 dl.<br>
		Sæt lemonaden på køl i 30-40 minutter. Hvis lemonaden er for sød, så tilsæt mere citronsaft.<br>
		Server den over isterninger og gerne med citronskiver og frisk mynte.</p>';
	}
?>

	<button class="knappen"><a href="logud.php">Log ud</a></button>
	
	
</body>
</html>