<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

	<?php
      include 'Database.php';
      $db=new Database;
     if (isset($_POST['submit'])) {
     	$filename=$_FILES['file']['name'];
     	$filetmpname=$_FILES['file']['tmp_name'];
     	$fileextension=pathinfo($filename,PATHINFO_EXTENSION);
     	$filetype=array('csv');
     	if (!in_array($fileextension,$filetype)) {
     	   echo "Invalid Data";
     	}
     	else{
     		$handle=fopen($filetmpname,'r');
     		while (($data=fgetcsv($handle,1000,','))!==false) {
     			$name=$data[0];
     			$skill=$data[1];
     			$salary=$data[2];

     			$sql="insert into tbl_user(name,skill,salary) values('".$name."','".$skill."','".$salary."')";
     			$result=$db->insertdata($sql);
     		}
     	}

     }


	 ?>
<form method="post" action=" " enctype="multipart/form-data">

	<input type="file" name="file">
	<input type="submit" name="submit">
	
</form>


<table>
	<tr>
		<th>id</th>
		<th>Name</th>
		<th>skill</th>
		<th>Salary</th>
		<th>Action</th>
  </tr>
  <?php 
   $sql="select * from tbl_user";
   $result=$db->selectdata($sql);
   if($result){
   	?>
   	<?php while ($row=$result->fetch_assoc() ) { ?>
  <tr>
  	<td><?php echo $row['id']; ?></td>
  	<td><?php echo $row['name']; ?></td>
  	<td><?php echo $row['skill']; ?></td>
  	<td><?php echo $row['salary']; ?></td>
  	<td><a href="?id=<?php echo $row['id']; ?>">delete</a></td>
  </tr>
<?php } ?>
<?php } ?>
</table>
<hr>
<?php 
if (isset($_GET['id'])) {
	$id=$_GET['id'];
	$sql="Delete from tbl_user where id=$id";
	$result=$db->deletedata($sql);
}
 ?>

<h1>Login</h1>
<?php 
 if (isset($_POST['login'])) {
 	$name=$_POST['name'];
 	$salary=$_POST['salary'];
 	
 	$sql="select name,salary from tbl_user where name='$name' AND salary='$salary' limit 1";
 	$result=$db->login($sql);
 	
 

 }

 ?>
<form method="post" action=" ">

	<input type="text" name="name" placeholder="name">
	<input type="text" name="salary" placeholder="salary">
	<input type="submit" name="login" value="login">
	
</form>

</body>
</html>