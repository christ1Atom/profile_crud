<?php
include 'dbh.php';

// checking to see if the user acessed the page correctly..
if(!$_SERVER["REQUEST_METHOD"]=="post"){
	header("location:index.php?error=error occur !");
	die();
}
if(!isset($_POST['submit'])){
	header("location:index.php?error=error occur !");
	die();
}

// geting variable from the post index.php
$file=$_FILES['file'];
$firstName=mysqli_real_escape_string($conn,$_POST['firstName']);
$lastName=mysqli_real_escape_string($conn,$_POST['lastName']);
$age=mysqli_real_escape_string($conn,$_POST['age']);
$mobile=mysqli_real_escape_string($conn,$_POST['mobile']);
$email=mysqli_real_escape_string($conn,$_POST['email']);
$code=(int)mysqli_real_escape_string($conn,$_POST['code']);

// variable for file checking
$fileName=$file['name'];
$fileSize=$file['size'];
$fileTmp=$file['tmp_name'];
$fileError=$file['error'];
$file_max=1000000;

//extracting extension
$allowed=array('png','jpeg','jpg');
$ext=explode('.',$fileName);
$extension=strtolower(end($ext));
$destination="uploads/";

if(empty($firstName) || empty($lastName) || empty($age) || empty($mobile) || empty($file['name']) || empty($code)){
	header("location:index.php?error=fill all fields !");
	die();
}
if(!filter_var($email,FILTER_SANITIZE_EMAIL)){
	header("location:index.php?error=invalid email !");
	die();
}

// checking for file error
if(!in_array($extension,$allowed)){
	header("location:index.php?error=invalid file type !");
	die();
}
if($fileSize > $file_max){
	header("location:index.php?error=file size too large !");
	die();
}
if($fileError > 0 ){
	header("location:index.php?error=error occur !");
	die();
}
if(strlen($mobile) > 8){
	header("location:index.php?error=display length 8");
}
if(strlen($code) > 3){
	header("location:index.php?error=enter code !");
}

// creating a complex name for file name
$str="abcdefghijklmnopqrstuvwxyz123456789()_-";
$randstr=substr(str_shuffle($str),0,7);
$new_file_name=$randstr . "." . $extension;
while(is_match($conn,$new_file_name) == true){
	$randstr=substr(str_shuffle($str),0,7);
	$new_file_name=$randstr . "." . $extension;
	is_match($conn,$new_file_name);
}

// insert things into file folder
insert($conn,$firstName,$lastName,$age,$mobile,$email,$new_file_name,$code,$fileTmp,$destination);
header("location:index.php?success=upload success !");
die();
function is_match($conn,$string){
	$sql="SELECT image from profile_logs;";
	$result=mysqli_query($conn,$sql);
	if(!mysqli_num_rows($result) > 0){
		return false;
	}
	while($row=mysqli_fetch_assoc($result)){
		if($row['image']==$string){
			return true;
			break;
		}
	}
	return false;
}
function insert($conn,$firstName,$lastName,$age,$mobile,$email,$new_file_name,$code,$fileTmp,$destionation){
	$sql="INSERT INTO profile_logs(firstName,lastName,age,phone,email,image,code) VALUES (?,?,?,?,?,?,?);";
	$stmt=mysqli_stmt_init($conn);
	if(!mysqli_stmt_prepare($stmt,$sql)){
		header("location:index.php?error=error occur !");
		die();
	}
	if(!mysqli_stmt_bind_param($stmt,"sssssss",$firstName,$lastName,$age,$mobile,$email,$new_file_name,$code)){
		header("location:index.php?erro=error occur !");
		die();
	}
	mysqli_stmt_execute($stmt);
	move_uploaded_file($fileTmp,$destionation.$new_file_name);
}


