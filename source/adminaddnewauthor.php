<?php
session_start();
error_reporting(0);
include('include/config.php');
if(strlen($_SESSION['adminform'])==0)
{
  echo"<script type='text/javascript'>alert('login first')</script>";
  echo"<script type='text/javascript'> document.location='adminlogin.php'; </script>";
}
else {
  if(isset($_POST['author']))
  {
    $authorid=$_POST['authorid'];
    $authorname=$_POST['authorname'];
    $sql2="SELECT * FROM authordetail WHERE author_id=:authorid,author_name=:authorname";
    $query2=$dbh->prepare($sql2);
    $query2->bindParam('authorid',$authorid,PDO::PARAM_STR);
    $query2->bindParam('authorname',$authorname,PDO::PARAM_STR);
    $query2->execute();
    $query2->fetchAll(PDO::FETCH_OBJ);
    if($query2->rowCount()>0)
    {
      echo"<script type='text/javascript'>alert('Can not add author');</script>";
    }
    else {


    $sql1="INSERT INTO authordetail(author_id,author_name) VALUES(:authorid,:authorname)";
    $query1=$dbh->prepare($sql1);
    $query1->bindParam('authorid',$authorid,PDO::PARAM_STR);
    $query1->bindParam('authorname',$authorname,PDO::PARAM_STR);
    $query1->execute();
    echo"<script type='text/javascript'>alert('Auhtor added');</script>";
  }
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
table{
  text-align: center;
}
.head1{
  position: relative;;
  left:25%;
  width:50%;
  margin-top: 100px;
}
.head{
  position: relative;
  left:25%;
  width:50%;
  margin-top: 100px;
}
.formbody
{
  position: relative;
  left:35%;
  width:30%;
  border:1px solid #33ccff;
}
.subhead
{
  background-color: #80ced6;
    border: 1px solid #33ccff;
      height:5%;
}
.inp
{
  position: relative;
  left:10%;
  width:80%;
}
.lab
{
  position: relative;
  left: 10%;

}
.sub{
  position: relative;
  left: 50%;
  background-color:  #80ced6;
  border: none;
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
    add author
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
  <div class="head">
  <h1>  Add Author</h1>
    <hr>
  </div>
  <div class="formbody">

    <div class="subhead">
      <label >
        Author Info
      </label>
  </div>
    <form name="form" class="" method="post">

      <label class="lab">
        Enter author id
      </label>
      <br>
      <input type="text" class="inp" name="authorid">
      <label class="lab">
        Enter author name
      </label>
      <br>
      <input type"text" class="inp" name="authorname">
      <br>
      <br>
      <input type="submit" name="author" value="ADD" class="sub">
    </form>
  </div>
</body>
</html>
<?php } ?>
