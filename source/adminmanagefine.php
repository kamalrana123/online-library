<?php
session_start();
error_reporting(0);
include('include/config.php');
if(strlen($_SESSION['adminform'])==0)
{
  echo "<script type='text/javascript'>alert('login first');</script>";
  echo "<script type='text/javascript>document.location='login1.php';</script>'";
}
else {
  if(isset($_GET['Fine']))
  {
    $userId=$_GET['studentID'];
    $sql1="SELECT * FROM finetable WHERE user_id=:userId";
    $query1=$dbh->prepare($sql1);
    $query1->bindParam('userId',$userId,PDO::PARAM_STR);
    $query1->execute();
    if($query1->rowCount()>0)
    {
      $_SESSION['fineId']=$_GET['studentID'];
      echo "<script type='text/javascript'>document.location='adminfine.php';</script>";
       }
    else {
      echo "<script type='text/javascript'>alert('No Fine');</script>";
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

.form1
{

  position: relative;
  margin-top: 3%;
  left:35%;
  border: 1px solid#33ccff;
  width: 30%;
}
.sub{  position: relative;
  left: 40%;
  background-color:  #80ced6;
  border: none;
  width:10%;
}.formhead{
  border:1px solid #33ccff;
    background-color:  #80ced6;
}
.uphead
{
  position: relative;
  left:25%;
  width:50%;
  margin-top: 5%;
}
label{
  position: relative;
  left:35%;
}
input
{
  position:relative;
  left:30%
}

  </style>
  <script>
function openNav() {
  document.getElementById("mySidenav").style.width = "250px";
}

function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
}
</script>
  <title>
    fine
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
  <h4>Manage Fine</h4>
  <hr>
</div>
<div class="form1">
  <div class="formhead">
    fine
  </div>
  <form method="get" class="form" name="isbook">
    <label>
      Enter Student Id
    </label>
    <br>
    <input type="text" name="studentID" required>
    <br>
    <input type="submit" name="Fine"class="sub">
  </form>
</div>

</body>
</html>
<?php } ?>
