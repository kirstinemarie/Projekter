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
<a href="categoryimage.php">Go back</a>
	<ul>
	
<?php
		
	$cnam = filter_input(INPUT_GET, 'categoryname') 
		or die('Missing/illegal category parameter');
		
	echo '<h1>Category ' .$cnam. '.</h1>';
		
	$cid = filter_input(INPUT_GET, 'category_id', FILTER_VALIDATE_INT) 
		or die('Missing/illegal category parameter');		

	
	require_once('db_con.php');
	$sql = 'SELECT c.category_id, i.category_category_id, i.imageurl, i.title, i.id
FROM category c, image i
WHERE c.category_id = i.category_category_id
AND c.category_id =?
ORDER by i.id DESC';
	$stmt = $con->prepare($sql);
	$stmt->bind_param('i', $cid);
	$stmt->execute();
	$stmt->bind_result($cid, $categorynumber, $url, $title, $id);
	while ($stmt->fetch()){ ?>
	
	<h2> <?=$id?>: <?=$title?></h2>
	<img src="<?=$url?>" width="180px" />
<?php } ?>
</div>
</body>
</html>