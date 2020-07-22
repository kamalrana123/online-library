<?php
session_start();
error_reporting(0);
include('include/config.php');
if(strlen($_SESSION['adminform'])==0)
{
  echo "<script type='text/javascript'>alert('login first');</script>";
  echo "<script type='text/javascript>document.location='login1.php';</script>'";
}else {
  $userId=$_SESSION['adminform'];
  if(isset($_POST['chpass']))
  {
    $newpassword=md5($_POST['newpass']);
    $pass=md5($_POST['oldpass']);
    $sql="SELECT * FROM adminlogin WHERE adminId=:userId AND password=:pass";
    $query1=$dbh->prepare($sql);
    $query1->bindParam('userId',$userId,PDO::PARAM_STR);
    $query1->bindParam('pass',$pass,PDO::PARAM_STR);
    $query1->execute();
    if($query1->rowCount()>0)
    {
      $sql1="UPDATE adminlogin SET password=:newpassword WHERE adminId=:userId";
      $query2=$dbh->prepare($sql1);
      $query2->bindParam('userId',$userId,PDO::PARAM_STR);
      $query2->bindParam('newpassword',$newpassword,PDO::PARAM_STR);
      $query2->execute();
      echo"<script type='text/javascript'>alert('password changed');</script>";
      echo "<script type='text/javascript'>document.location='admindashboard.php';</script>";
    }
    else {
      echo"<script type='text/javascript'>alert('old password do not match');</script";
    }
  }
  ?>
  <!DOCTYPE html>
  <html>
  <head>

    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/myfile.css">
  <link rel="stylesheet" type="text/css" href="css/myfile2.css">
  <link rel="stylesheet" type="text/css" href="css/myfile3.css">

    <style type="text/css">
      ul{
        list-style-type: none;
          margin: 0;
          padding: 0;
          overflow: hidden;
          background-color: #333;
      }
      li{
        float:right;
      }
      .webName
      {
        float:left;
      }
      li a {
          display: block;
        color: white;
        text-align: center;
          padding: 14px 16px;
          text-decoration: none;
      }

  li a:hover {
    background-color: #111;
  }
  .form1{
    position: relative;
    left: 30%;
    width:40%;
    border: 1px solid #33ccff;
  }
  .uphead
  {
    position: relative;
    left:25%;
    width:50%;
    margin-top: 5%;
  }
  .formhead{

    border: 1px solid #33ccff;
    background: #80ced6;
  }
  input
  {
    position:relative;
    width: 60%;
    left: 20%;
  }
  .sub{
    position: relative;
  left: 40%;
  background-color:  #80ced6;
  border: none;
  width:20%;
  }
  label{
    position:relative;
    left: 20%;
  }
    </style>
    <script type="text/javascript">
		function validatePass() {

			var pass = document.forms["changepass"]["newpass"].value;
			var repass = document.forms["changepass"]["renewpass"].value;
			if (pass!=repass) {
				alert("password do not match");
				return false;
			}
		}
    </script>
    <script>
  function openNav() {
    document.getElementById("mySidenav").style.width = "250px";
  }

  function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
  }
  </script>
    <title>
      Change password
    </title>
  </head>
  <body>
  <ul>
  <li class="webName"><a class="active" href="#home">Library management system</a>  <div id="mySidenav" class="sidenav">
    <?php include_once('include/sidenav.php'); ?>
  </div>
  <span style="font-size:30px;cursor:pointer;color:white" onclick="openNav()">&#9776; </span></li>
  <li><a href="adminlogout.php">logout</a></li>
  <li><a href="adminchangepassword.php">Change password</a></li>
  </ul>
  <div class="uphead">
    <h4>Change Password<h4>
      <hr>
  </div>

  <div onsubmit="return validatePass()" class="changepass">
<form action="" method="post" class="form1" name="changepass">
  <div class="formhead">
    Change Password
  </div>
<label>Enter Old Password</label>
<br>
<input type="password" name="oldpass">
<br>
<label>Enter New Password</label>
<br>
<input type="password" name="newpass">
<br>
<label>Re Enter New Password</label>
<br>
<input type="password" name="renewpass">
<br>
<input type="submit" name="chpass" class="sub">
</form>
</div>
</body>
</html>
<?php } ?>
