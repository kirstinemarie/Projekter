<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Tilmeld Dig</title>
<link rel="stylesheet" href="logind_stylesheet.css">
</head>

<body>
<h1> WHEN LIFE GIVES YOU LEMONS</h1>
<?php
	
	if(filter_input(INPUT_POST, 'submit')){
		
	$un = filter_input(INPUT_POST, 'un')
		or die('Ugyldig brugernavn');
		
	$pw = filter_input(INPUT_POST, 'pw')
		or die('Ugyldig kodeord');
		
		$pw = password_hash($pw, PASSWORD_DEFAULT);
		
		
		
		require_once('db_con.php');
		
		$sql = 'INSERT INTO users (username, pwhash) VALUES  (?, ?)';
		
		$stmt = $con->prepare($sql);
		$stmt->bind_param('ss', $un, $pw);
		$stmt->execute();
		
		if($stmt->affected_rows > 0){
			echo '<h2>Bruger '.$un.' er oprettet</h2>';
			echo '<br> <button class="ind "><a href="startside.php">Log ind</a></button><br>';
		}
		else {
			echo '<h2>kunne ikke oprette bruger</h2>';
		}
	
		
		//$sql = 'select id, des from xyz where n=? aw na=?;
		//$stmt = $link->prepare($sql);
		
		
	
	}
	?>
	<div class="log">

<form  action="<?=$_SERVER['PHP_SELF']?>" method="post">

		<legend>Opret bruger her</legend>
		
		<input class="feldt" type="text" name="un"  placeholder="Brugernavn" required><br>
			
		<input class="feldt" type="password" name="pw" placeholder="Kodeord" required><br>
		
	
		<input class="knap" type='submit' id="send" value="Tilmeld" name="submit">
		
		<button class="knap"><a href="startside.php">Startside</a></button>
		
		
	
	</form>
	
	</div>
	


</body>
</html>