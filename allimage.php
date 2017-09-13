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
		
	}
</style>

<body>
<div class="container">
	<h1>Images uploaded to the system</h1>
	<a href="categoryimage.php">Go back</a>
	
<?php
	if($submit = filter_input(INPUT_POST, 'submit')){
	if($submit == 'del_image') {
		
		$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT) 
			or die('Missing/illegal id parameter');
		$url = filter_input(INPUT_POST, 'url') 
			or die('Missing/illegal url parameter');
		
		require_once('db_con.php');
		$sql = 'DELETE FROM image WHERE id=?';
		$stmt = $con->prepare($sql);
		$stmt->bind_param('i', $id);
		$stmt->execute();
	
		if($stmt->affected_rows > 0){
			echo 'Deleted image number '.$id;
			unlink($url);
		}
		else {
			echo 'Could not delete image '.$id;
		}
	}
	else {
		die('Unknown cmd: '.$submit);
	}
	}
	require_once('db_con.php');
	$sql = 'SELECT i.id, i.title, i.imageurl, i.category_category_id, c.name, c.category_id
FROM image i, category c 
Where i.category_category_id = c.category_id
ORDER by i.id ASC';
	$stmt =$con->prepare($sql);
	$stmt->execute();
	$stmt->bind_result($id, $title, $url, $category_id, $nam, $cid);
	
	while($stmt->fetch()){ ?>
		
	<h2><?=$id?> // <?=$nam?> // <?=$title?></h2>
	<img src="<?=$url?>" width="180px" />
	<form action="<?=$_SERVER['PHP_SELF']?>" method="post">
	<input type="hidden" name="url" value="<?=$url?>" />
	<input type="hidden" name="id" value="<?=$id?>" />
	<button name="submit" type="submit" value="del_image">Delete</button>
	<a href="renamecategory.php?id=<?=$id?>"> Rename title </a>
	</form>
<?php } ?>

	</div>
</body>
</html>
