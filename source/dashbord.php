<?php
session_start();
error_reporting(0);
include('include/config.php');
if(strlen($_SESSION['login'])==0)
{
  echo"<script type='text/javascript'>alert('login first');</script>";
  echo"<script type='text/javascript'>document.location='login1.php'; </script>";
}
else {
  $loginVarName=$_SESSION['login'];
?>

<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/myfile3.css">
    <link rel="stylesheet" type="text/css" href="css/myfile.css">
  <style>
body {
  font-family: "Lato", sans-serif;
}

.sidenav {
  height: 100%;
  width: 0;
  position: fixed;
  z-index: 1;
  top: 0;
  left: 0;
  background-color: #111;
  overflow-x: hidden;
  transition: 0.5s;
  padding-top: 60px;
}

.sidenav a {
  padding: 8px 8px 8px 32px;
  text-decoration: none;
  font-size: 25px;
  color: #818181;
  display: block;
  transition: 0.3s;
}

.sidenav a:hover {
  color: #f1f1f1;
}

.sidenav .closebtn {
  position: absolute;
  top: 0;
  right: 25px;
  font-size: 36px;
  margin-left: 50px;
}

@media screen and (max-height: 450px) {
  .sidenav {padding-top: 15px;}
  .sidenav a {font-size: 18px;}
}
</style>
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
    dashboard
  </title>
</head>

<body>
  <ul>
    <li class="webName"><a class="active" href="#home">Library management system</a>  <div id="mySidenav" class="sidenav">
      <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
      <a href="dashbord.php"> DASHBOARD </a>
      <a href="issuedBooks.php"> BOOKS ISSUED </a>
      <a href="availablebook.php"> AVAILABLE BOOK </a>
    </div>
    <span style="font-size:30px;cursor:pointer;color:white" onclick="openNav()">&#9776; </span></li>
    <li><a href="logout.php">logout</a></li>
    <li><a href="userprofile.php">User profile</a></li>
    <li><a href="setting.php">Setting</a></li>
  </ul>

  <!--<h1>welcome to dshboard</h1>-->
  <?php
$sql="SELECT user_id FROM transactionTable WHERE user_id=:loginVarName";
$query=$dbh ->prepare($sql);
$query ->bindParam('loginVarName',$loginVarName,PDO::PARAM_STR);
$query ->execute();
$result=$query ->fetchAll(PDO::FETCH_OBJ);
$issuedbooks=$query ->rowCount();
//echo"$issuedbooks";
   ?>
   <?php
   $sql1="SELECT user_id FROM transactionRecord WHERE user_id=:loginVarName";
   $query1=$dbh ->prepare($sql1);
   $query1 ->bindParam('loginVarName',$loginVarName,PDO::PARAM_STR);
   $query1 ->execute();
   $result1=$query1 ->fetchAll(PDO::FETCH_OBJ);
   $totalIssued=$query1 ->rowCount();
    ?>
    <?php
    $sql2="SELECT fine FROM finetable WHERE user_id=:loginVarName";
    $query2=$dbh ->prepare($sql2);
    $query2 ->bindParam('loginVarName',$loginVarName,PDO::PARAM_STR);
    $query2 ->execute();
    $result2=$query2 ->fetchAll(PDO::FETCH_OBJ);
    $total=$query2 ->rowCount();
     ?>
  <table align="center" style="margin-top: 10%;">
    <tr>
      <td>
  <div class="flip-box">
  <div class="flip-box-inner">
    <div class="flip-box-front">
      <h2>TOTAL BOOKS ISSUED</h2>
    </div>
    <div class="flip-box-back">
      <h2><?php echo htmlentities($totalIssued); ?></h2>
    </div>
  </div>
</div>
</td>
<td>
  <div class="flip-box">
  <div class="flip-box-inner">
    <div class="flip-box-front">
      <h2>BOOKS NOT RETURNED YET</h2>
    </div>
    <div class="flip-box-back">
      <h2><?php echo htmlentities($issuedbooks); ?></h2>
    </div>
  </div>
</div>
</td>
<td>
  <div class="flip-box">
  <div class="flip-box-inner">
    <div class="flip-box-front">
      <h2>FINE</h2>
    </div>
    <div class="flip-box-back">
      <h2><?php foreach ($result2 as $result) {
        echo htmlentities($result ->fine);
      } ?></h2>
    </div>
  </div>
</div>
</td>
</tr>
</table>
<?php } ?>
</body>
</html>
