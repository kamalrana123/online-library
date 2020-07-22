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
  $userId=$_SESSION['fineId'];

  $sql1="SELECT fine FROM finetable WHERE user_id=:userId";
  $query1=$dbh->prepare($sql1);
  $query1->bindParam('userId',$userId,PDO::PARAM_STR);
  $query1->execute();
  $result=$query1->fetchAll(PDO::FETCH_OBJ);
  if(isset($_GET['return']))
  {
    $newfin=$_GET['returnfine'];
    foreach ($result as $result2) {
      $fin=$result2->fine;
    }
    $fin=$fin-$newfin;
    //echo "$fin";
      $sql2="UPDATE finetable SET fine=:fin WHERE user_id=:userId";
      $query2=$dbh->prepare($sql2);
      $query2->bindParam('userId',$userId,PDO::PARAM_STR);
      $query2->bindParam('fin',$fin,PDO::PARAM_STR);
      $query2->execute();
  }
  if(isset($_GET['add']))
  {
    $newfin=$_GET['addfine'];
    foreach ($result as $result3) {
      $fin2=$result3->fine;
    }
    $fin2=$fin2+$newfin;
    //echo "$fin";
      $sql3="UPDATE finetable SET fine=:fin2 WHERE user_id=:userId";
      $query3=$dbh->prepare($sql3);
      $query3->bindParam('userId',$userId,PDO::PARAM_STR);
      $query3->bindParam('fin2',$fin2,PDO::PARAM_STR);
      $query3->execute();
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


table {
  border-collapse: collapse;
  width: 60%;
  height: 50%;
  margin-top: 5%;
}

th, td {
  text-align: center;
  padding: 8px;
  font-size: 40px
}

tr:nth-child(even){background-color: #f2f2f2}

th {
  background-color:#80ced6 ;
  color: white;
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
<form method="get">
<table align="center" border="1px">
  <tr>
  <th colspan="2">
    Fine On Student
  </th>
</tr>
<tr>
  <td colspan="2">
<?php
$sql4="SELECT fine FROM finetable WHERE user_id=:userId";
$query4=$dbh->prepare($sql4);
$query4->bindParam('userId',$userId,PDO::PARAM_STR);
$query4->execute();
$result1=$query4->fetchAll(PDO::FETCH_OBJ);
foreach ($result1 as $result01) {
  echo htmlentities($result01->fine);
}
 ?>
  </td>
</tr>
<tr>
  <th>
    Return Fine
  </th>
  <th>
    Add Fine
  </th>
</tr>
<tr>
  <td>
  <input type="text" name="returnfine" >
  <td>
    <input type="text" name="addfine" >
  </td>
</tr>
<tr>
  <td>
    <input type="submit" name="return">
  </td>
  <td>
  <input type="submit" name="add">
</td>
</tr>
</table>
</form>
</body>
</html>
<?php } ?>
