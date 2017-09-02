<?php session_start(); //starter vores session 

?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Startside</title>
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
		
	require_once('db_con.php');
		
	$sql= 'SELECT id, pwhash FROM users WHERE username=?'; // samler vores passwword hash op og bruger til at sikre vores log ind ved brug af algoritmer
	$stmt = $con->prepare($sql);
	$stmt->bind_param('s', $un);
	$stmt->execute();
	$stmt->bind_result($uid, $pwhash); 
	
		
	while($stmt->fetch()){		
	}
		
		
		if(password_verify($pw, $pwhash)){
			echo "<script>window.open('baseside.php','_self')</script>";
			$_SESSION['uid'] =$uid; // session tjekker efter gemt  id 
			$_SESSION['username'] =$un;// session tjekker efter gemt brugernavn 
		}
		else{
			echo 'ubruglig log ind';
		}}
	
	?>
	
	<div class="log">
<form  action="<?=$_SERVER['PHP_SELF']?>" method="post">

<legend>Log Ind</legend>
		
		<input class="feldt"  type="text" name="un"  placeholder="Brugernavn" required><br>
			
		<input class="feldt"  type="password" name="pw" placeholder="Kodeord" required><br>
		
	
		<input class="knap" type='submit' id="send" value="log ind" name="submit">
		
		
		
		<button class="knap"><a href="tilmelding.php">Opret Bruger</a></button>
		
		
	
	</form></div>
</body>
</html>