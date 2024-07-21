<!DOCTYPE html>
<html lang="en">
<head>
<title>profile crud</title>
<link rel="stylesheet" href="style.css"/>
</head>
<body>
<?php include 'read.php';?>
<?php 

if(!isset($_GET['id'])){
?>
	<form action="create.php" method="post" enctype="multipart/form-data">
<?php 
	if(isset($_GET['error'])){
		$error=$_GET['error'];
		echo '<p style="text-align:center; font-size:20px; color:red;">' . $error . '</p>';
	}elseif(isset($_GET['success'])){
		$success=$_GET['success'];
		echo '<p style="text-align:center; font-size:20px; color:green;">' . $success . '</p>';
	}
?>
		<input type="text" name="firstName" placeholder="FirstName:"/>
		<input type="text" name="lastName" placeholder="LastName:"/>
		<input type="number" name="age" placeholder="Age:"/>
		<select name="code">
			<option value="123">+123</option>
			<option value="321">+321</option>
			<option value="443">+443</option>
		</select>
		<input type="number" name="mobile" placeholder="Phone:" class="n"/>
		<input type="email" name="email" placeholder="E-mail"/>
		<label for="file" class="label">Select File (image)</label>
		<input type="file" name="file" id="file" style="display:none"/>
		<input type="submit" name="submit" value="upload"/>
	</form>
<?php
}
?>
</body>
</html>
