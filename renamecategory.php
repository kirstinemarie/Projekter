<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Untitled Document</title>
</head>
<style>
	body{
		background-color: hsla(182,17%,66%,1.00);
		font-family: Helvetica, Arial," sans-serif";
	}
	.container {
		margin-left: 50px;
		width: 300px;
	}
</style>


<body>
<div class="container">

<?php
if($cmd = filter_input(INPUT_POST, 'cmd')){
	if($cmd == 'rename_title') {
		$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT) 
			or die('Missing/illegal id parameter');
		$title = filter_input(INPUT_POST, 'title') 
			or die('Missing/illegal catname parameter');
		
		require_once('db_con.php');
		$sql = 'UPDATE image SET title=? WHERE id=?';
		$stmt = $con->prepare($sql);
		$stmt->bind_param('si', $title, $id);
		$stmt->execute();
		
		if($stmt->affected_rows > 0){
			echo 'Changed title name to '.$title;
		}
		else {
			echo 'Could not change the name of the title';
		}	
	}
}
?>



<?php
	if (empty($id)){
		$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT) 
			or die('Missing/illegal id parameter');	
	}
	require_once('db_con.php');
	$sql = 'SELECT title FROM image WHERE id=?';
	$stmt = $con->prepare($sql);
	$stmt->bind_param('i', $id);
	$stmt->execute();
	$stmt->bind_result($title);
	while($stmt->fetch()){} 
?>

<p>
<form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
	<fieldset>
    	<legend>Rename title</legend>
    	<input name="id" type="hidden" value="<?=$id?>" />
    	<input name="title" type="text" value="<?=$title?>" />
    	<button name="cmd" type="submit" value="rename_title">Save new title</button>
	</fieldset>
</form>
</p>

	<a href="allimage.php">Go Back</a>
</div>
</body>
</html>