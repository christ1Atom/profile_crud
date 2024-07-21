<?php
include 'dbh.php';

$sql="SELECT * FROM profile_logs;";
$result=mysqli_query($conn,$sql);
if(!mysqli_num_rows($result)>0){
	echo '<p style="text-align:center; color:red; margin-bottom:10px;">No record found !</p>';
}
while($row=mysqli_fetch_assoc($result)){

	if(@$_GET['id']==$row['id']){
		echo '<form action="update.php" method="post" enctype="multipart/form-data" class="update-form">';
		echo '<p><input type="text" name="firstName" value="'. $row["firstName"].'"/></p>';
		echo '<p><input type="text" name="lastName" value="'. $row["lastName"].'"/></p>';
		echo '<p><input type="number" name="age" value="'. $row["age"].'"/></p>';
		echo '<p>
		<select name="code">
			<option value="123">' . $row["code"] . '</option>
			<option value="321">+321</option>
			<option value="443">+443</option>
		</select>
		</p>';
		echo '<p><input type="number" name="mobile" value="'. $row["phone"].'"/></p>';
		echo '<p><input type="email" name="email" value="'. $row["email"].'"/></p>';
		echo '<input type="hidden" name="id" value="'.$row["id"].'"/>';
		echo '<p><input type="file" name="file" id="file" style="display:none"/>';
		echo '<label for="file">SELECT NEW FILE (image)</label>';
		echo '<p><input type="submit" name="submit" value="save"/></p>';
		echo '</form>';
	}else{
		echo '<div>';
		echo '<p><img src="uploads/' . $row["image"] . '"/></p>';
		echo '<p>' . $row["firstName"] . '</p>';
		echo '<p>' . $row["lastName"] . '</p>';
		echo '<p>' . $row["age"] . '</p>';
		echo '<p>' . $row["email"] . '</p>';
		echo '<p>+' . $row["code"] . '</p>';
		echo '<p>' . $row["phone"] . '</p>';
		echo '<p><a href="index.php?id='.$row["id"].'"style="color:lightgreen;">UPDATE</a></p>';
		echo '<p ><a href="delete.php?id='.$row["id"].'&img=' . $row["image"] . '"style="color:red;">DELETE</a></p>';
		echo '</div>';
	}

}
mysqli_free_result($result);
