<?php
session_start();
error_reporting(0);
	include('include/config.php');
	if($_SESSION['adminform']!=''){
		$_SESSION['adminform']='';
	}
	if(isset($_POST['adminform'])){
		//echo"isiside";
		$adminId=$_POST['adminId'];
		$password=md5($_POST['password']);
	//	echo"$adminId";
	//	echo"$password";
		$sql="SELECT adminId,password FROM adminlogin WHERE adminId=:adminId and password=:password";
		$query=$dbh ->prepare($sql);
		$query ->bindParam('adminId',$adminId,PDO::PARAM_STR);
		$query ->bindParam('password',$password,PDO::PARAM_STR);
		$query ->execute();
		$results=$query->fetchAll(PDO::FETCH_OBJ);
		if($query->rowCount() >0)
		{
			$_SESSION['adminform']=$_POST['adminId'];
			echo"<script type='text/javascript'> document.location='adminDashboard.php'; </script>";
		}
		else {
			echo"<script type='text/javascript'> alert('password is not correct');</script>";
		}
	}
 ?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	  <link rel="stylesheet" type="text/css" href="css/myfile3.css">

	<title>
		admin login
	</title>
	<script type="text/javascript">
	function validatePass() {
		var pass=document.forms['adminform']['password'].value;
		var repass=document.forms['adminform']['repassword'].value;
		if(pass!=repass)
		{
			alert("password do not match");
			return false;
		}

	}
	</script>
	<style type="text/css">

.adminform
{
  position: relative;
  z-index: 1;
  background: #FFFFFF;
  max-width: 360px;
  margin: 0 auto 100px;
  padding: 45px;
  text-align: center;
  box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
  margin-top: 10%;
}
.adminform .button
{
  font-family: "Roboto", sans-serif;
  text-transform: uppercase;
  outline: 0;
  background: #4CAF50;
  width: 50%;
  border: 0;
  padding: 10px;
  color: #FFFFFF;
  font-size: 12px;
  -webkit-transition: all 0.3 ease;
  transition: all 0.3 ease;
  cursor: pointer;
}

</style>
</head>
<body>
	<ul>
		<li class="webName"><a class="active" href="#home">Library management system</a></li>
  		<li><a href="adminlogin.php">Admin login</a></li>
  		<li><a href="login1.php">User Login</a></li>
  		<li><a href="signup.php">User signup</a></li>
	</ul>
	<div onsubmit="return validatePass() "class="adminform">
		<form action="" method="post" name="adminform">
			<p>Admin ID</p>
			<input type="text" name="adminId" required>
			<p>Password</p>
			<input type="password" name="password" required>
			<p>Confirm Password</p>
			<input type="password" name="repassword" required>
			<br>
			<br>
			<input class="button" type="submit" name="adminform" value="login">
		</form>
	</div>
</body>
</html>
