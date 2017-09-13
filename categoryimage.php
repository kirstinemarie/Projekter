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
	if($cmd == 'add_category') {
		$catname = filter_input(INPUT_POST, 'catname') 
			or die('Missing/illegal catname parameter');
		
		require_once('db_con.php');
		$sql = 'INSERT INTO category (name) VALUES (?)';
		$stmt = $con->prepare($sql);
		$stmt->bind_param('s', $catname);
		$stmt->execute();
		
		if($stmt->affected_rows > 0){
			echo 'Added '.$catname.' as category '.$stmt->insert_id;
		}
		else {
			echo 'Could not create the new category!!!';
		}	
	}
	
	elseif($cmd == 'del_category') {
		$cid = filter_input(INPUT_POST, 'cid', FILTER_VALIDATE_INT) 
			or die('Missing/illegal cid parameter');
		
		require_once('db_con.php');
		$sql = 'DELETE FROM category WHERE category_id=?';
		$stmt = $con->prepare($sql);
		$stmt->bind_param('i', $cid);
		$stmt->execute();
		
		if($stmt->affected_rows > 0){
			echo 'Deleted category number '.$cid;
		}
		else {
			echo 'Could not delete category '.$cid;
		}
	}
	else {
		die('Unknown cmd: '.$cmd);
	}
}
?>


	<h1>Categories</h1>
	<ul>
<?php
	require_once('db_con.php');
	
	$sql = 'SELECT category_id, name FROM category ORDER BY name ASC';
	$stmt = $con->prepare($sql);
	// $stmt->bind_param();  not needed - no placeholders....
	$stmt->execute();
	$stmt->bind_result($cid, $nam);
	
	while($stmt->fetch()){ 
//  	echo '<li><a href=”filmlist.php?categoryid='.$cid.'”>'.$nam.'</a>';
//		echo '<a href=”renamecategory.php?categoryid='.$cid.'”>Rename</a>';
//		echo '<form action="'.$_SERVER['PHP_SELF'].'" method="post">';
//		echo '<input type="hidden" name="cid" value="'.$cid.'" />';
//		echo '<button name="cmd" type="submit" value="del_category">Delete</button>';
//		echo '</form></li>'.PHP_EOL;
?>
<li><a href="imagelist.php?category_id=<?=$cid?>&categoryname=<?=$nam?>"><?=$nam?></a> : 
	<form action="<?=$_SERVER['PHP_SELF']?>" method="post">
		<input type="hidden" name="cid" value="<?=$cid?>" />
		<button name="cmd" type="submit" value="del_category">Delete</button>
	</form>
</li>
<?php
	}	
?>
	</ul>
	<br><br>

	<p>
<form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
	<fieldset>
    	<legend>Create new category</legend>
    	<input name="catname" type="text" placeholder="Category name" required />
		<button name="cmd" type="submit" value="add_category">Create</button>
	</fieldset>
</form>
</p>
	<h1>Image stuff</h1>

	Lets <a href="allimage.php">view all pictures</a>
	<br><br><br>
	<h2>Upload a new picture</h2>
	<form action="upload.php" method="post" enctype="multipart/form-data">
    Select image to upload:<br>
    	<input type="text" name="title" placeholder="Image title" required />
    	<input type="file" name="fileToUpload" id="fileToUpload"><br>
    	<input type="submit" value="Upload Image" name="submit">
   
    <select name='minDropListe'>
      <?php
	require_once('db_con.php');
	
	$sql = 'SELECT category_id, name FROM category';
	$stmt = $con->query($sql);
		
		if($stmt->num_rows > 0){
			
		while($row = $stmt->fetch_assoc()){ 
			
			echo "<option require placeholder='category' name='category_id'  value='".$row['category_id']."'>".$row['name']."</option>";
		}}
		else {
			echo 'Could not find category '.$cid;
		
		}
		?>	</select>
   	
   	
	</form>
	</div>
</body>
</html>