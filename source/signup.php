<?php
session_start();
error_reporting(0);
	include('include/config.php');
if($_SESSION['signup']!='')
{
	$_SESSION['signup']='';
}
if(isset($_POST['signup']))
{
	$name=$_POST['name'];
	$email=$_POST['email'];
	$userId=$_POST['userId'];
	$password=md5($_POST['password']);
	$null="";
//echo"$name";
//echo"$email";
//echo"$userId";
//echo"$password";
$sql="SELECT user_id FROM userinfo WHERE user_id=:userId";
$query=$dbh ->prepare($sql);
$query ->bindParam('userId',$userId,PDO::PARAM_STR);
$query ->execute();
$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{
	echo"<script type='text/javascript'>alert('user already exists');</script>";
}
else {
	$sql1="INSERT INTO studenttable(user_id,user_pass) VALUES(:userId,:password)";
	$query1=$dbh ->prepare($sql1);
	$query1 ->bindParam('userId',$userId,PDO::PARAM_STR);
	$query1 ->bindParam('password',$password,PDO::PARAM_STR);
	$query1 ->execute();
	$sql2="INSERT INTO userinfo(user_id,name,roll_no,course,semester,email) VALUES(:userId,:name,'','','',:email)";
	$query=$dbh ->prepare($sql2);
	$query ->bindParam(':userId',$userId,PDO::PARAM_STR);
	$query ->bindParam(':name',$name,PDO::PARAM_STR);
	$query ->bindParam(':email',$email,PDO::PARAM_STR);
	$query ->execute();
	$sql3="INSERT INTO finetable(user_id) VALUES(:userId)";
	$query3=$dbh->prepare($sql3);
	$query3->bindParam('userId',$userId,PDO::PARAM_STR);
	$query3->execute();
	echo"<script type='type/javascript'>alert('account created');<script>";
}
}
 ?>
<!DOCTYPE html>
<html>
<head>
	<script type="text/javascript">
		function validatePass() {

			var pass = document.forms["signupForm"]["password"].value;
			var repass = document.forms["signupForm"]["repassword"].value;
			if (pass!=repass) {
				alert("password do not match");
				return false;
			}
		}
	</script>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/myfile3.css">
	<style type="text/css">

.signupForm
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
.signupForm .button
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
	<title>
		signup
	</title>
</head>
<body>
<ul>
  <li class="webName"><a class="active" href="#home">Library management system</a></li>
  <li><a href="adminlogin.php">Admin login</a></li>
  <li><a href="login1.php">User Login</a></li>
  <li><a href="signup.php">User signup</a></li>
</ul>
<div onsubmit="return validatePass()" class="signupForm">
	<form action=""method="POST" name="signupForm" >
		<p>Name</p>
		<input type="text" name="name" required>
		<p>Email</p>
		<input type="email" name="email" required>
		<p>User Id</p>
		<input type="text" name="userId" required>
		<p>Password</p>
		<input type="password" name="password" required>
		<p>Confirm Password</p>
		<input type="password" name="repassword" required>
		<span id="msg1" style="color:red"></span>
		<br>
		<br>
		<input class="button" type="submit" name="signup" value="signup">
	</form>
</div>

</body>
</html>
