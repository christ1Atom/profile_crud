<?php
include 'dbh.php';

$id=mysqli_real_escape_string($conn,$_GET['id']);
$image=mysqli_real_escape_string($conn,$_GET['img']);
$sql="DELETE FROM profile_logs  WHERE id=? AND image=?;";
$destination="uploads/";
$fileName=$destination . $image;
if(unlink($fileName)){

$stmt=mysqli_stmt_init($conn);
if(!mysqli_stmt_prepare($stmt,$sql)){
	header("location:index.php?errro=error occurs !");
	die();
}
mysqli_stmt_bind_param($stmt,"ss",$id,$image);
mysqli_stmt_execute($stmt);
// echo "yes";
	header("location:index.php?success=deleted success !");
	die();
}else{
	header("location:index.php?error=file not deleted?");
	die();
}
