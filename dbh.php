<?php
$server="127.0.0.1";
$username="root";
$pwd="";
$dbname="try_db";
$conn=mysqli_connect($server,$username,$pwd,$dbname);

if(!$conn){
	die("Connection failed: " . mysqli_connect_error($conn));
}
