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
$userId=$_SESSION['login'];
if(isset($_POST['edit']))
{
  echo"<script type=text/javascript>document.location='updateProfile.php';</script>";
}
?>

<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/myfile.css">
    <link rel="stylesheet" type="text/css" href="css/myfile3.css">
  <style>
body {
  font-family: "Lato", sans-serif;
}
.btn {
  background-color: #4CAF50; /* Green */
  border: none;
  color: white;
  padding: 16px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  transition-duration: 0.4s;
  cursor: pointer;
}

.btn {
  background-color: white;
  color: black;
  border: 2px solid #4CAF50;
}

.btn:hover {
  background-color: #4CAF50;
  color: white;
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

li a:hover {opacity: 1}
 {
  background-color: #111;

}

  </style>
  <style>
table {
border-collapse: collapse;
  border: 1px solid black;
width: 30%;
height:50%;
margin-top: 5%;
}

th, td {
text-align: left;
padding: 8px;
}

tr:nth-child(even){background-color: #f2f2f2}

th {
background-color: #4CAF50;
color: white;
}
td{
  text-align: center;
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
      <a href="dashbord.php">DASHBOARD</a>
      <a href="issuedBooks.php"> BOOKS ISSUED </a>
        <a href="availablebook.php"> AVAILABLE BOOK </a>
    </div>
    <span style="font-size:30px;cursor:pointer;color:white" onclick="openNav()">&#9776; </span></li>
    <li><a href="logout.php">logout</a></li>
    <li><a href="userprofile.php">User profile</a></li>
    <li><a href="setting.php">Setting</a></li>
  </ul>
  <?php
$sql="SELECT roll_no,user_id,name,course,semester FROM userinfo WHERE user_id=:userId";
$query=$dbh->prepare($sql);
$query->bindParam('userId',$userId,PDO::PARAM_STR);
$query->execute();
$result=$query->fetchAll(PDO::FETCH_OBJ);
foreach ($result as $results) {
  ?>
  <table align="center">
<tr>
  <th colspan="2">
<h2><?php echo htmlentities($results->name); ?></h2>
  </th>
</tr>
    <tr>
      <td>
  <label>Roll No</label>
</td>
<td>
  <?php echo htmlentities($results->roll_no); ?>
</td>
<tr>
  <td>
  <label>USER ID </label>
</td>
<td>
  <?php echo htmlentities($results->user_id); ?>
</td>
<tr>
  <td>
  <label>Name </label>
</td>
<td>
  <?php echo htmlentities($results->name); ?>
</td>
<tr>
  <td>
  <label>course </label>
</td>
<td>
  <?php echo htmlentities($results->course); ?>
</td>
<tr>
<td>
  <label>semester </label>
</td>
<td>
  <?php echo htmlentities($results->semester); ?>
</td>
</tr>
<tr >
  <td colspan="2">
    <form method="post">
  <input type ="submit" name="edit" value="update details" class="btn">
</form>
</td>
</tr>
</table>
<?php } ?>


<?php } ?>
</body>
</html>
