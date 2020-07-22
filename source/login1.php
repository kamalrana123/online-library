<?php
session_start();
error_reporting(0);
 include('include/config.php');
 if($_SESSION['login']!=''){
  $_SESSION['login']='';
 }
 if(isset($_POST['login'])){
//   echo "iside if";
 $userId=$_POST['userId'];
 $password=md5($_POST['password']);
 //echo " $userId";
 //echo " $password";
 $sql="SELECT user_id FROM studenttable WHERE user_id=:userId and user_pass=:password";
 $query= $dbh ->prepare($sql);
 $query-> bindParam(':userId', $userId, PDO::PARAM_STR);
$query-> bindParam(':password', $password, PDO::PARAM_STR);
$query ->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{
  $sql2="SELECT user_id FROM studenttable WHERE user_id=:userId and status='1'";
  $query2=$dbh->prepare($sql2);
  $query2->bindParam(':userId',$userId,PDO::PARAM_STR);
  $query2->execute();
  $result1=$query2->fetchAll(PDO::FETCH_OBJ);
  if($query2->rowCount()>0)
  {
  $_SESSION['login']=$_POST['userId'];
echo "<script type='text/javascript'> document.location ='dashbord.php'; </script>";
}
else {
  echo"<script type='text/javascript'>alert('Your account is suspended');</script>";
}
}
else {
//  echo"not hello";
  echo"<script type='text/javascript'>alert(' password is not correct');</script>";
}
}
 ?>
<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/myfile3.css">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script type="text/javascript">
    function validation()
    {
      userId=document.forms["loginForm"]["userId"].value;
      pass=document.forms["loginForm"]["password"].value;
      if (userId=="") {
        alert("enter valid user id");
        return false;
      }
      if(pass==""){
        alert("enter valid password");
        return false;
      }
    }
  </script>
<style>

</style>
</head>
<title>
  student login
</title>
<body>

<ul>
  <li class="webName"><a class="active" href="#home">Library management system</a></li>
  <li><a href="adminlogin.php">Admin login</a></li>
  <li><a href="login1.php">User Login</a></li>
  <li><a href="signup.php">User signup</a></li>
</ul>

<div onsubmit="return validation()" class="login">
  <form action ="" method="post" name="loginForm">
    <p>User ID</p>
    <span name="msg1" style="color:red"></span>
    <input type="text" name="userId" id="userId">
    <p>password</p>
    <span name="msg2" style="color:red"></span>
    <input type="password" name="password" id="pass">
    <br/><br/>
    <input class="button" type="submit" name="login" value="login">
  </form>
</div>

</body>
</html>
