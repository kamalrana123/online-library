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
  $useId=$_GET['userId'];
  //echo"$useId";
  if(isset($_POST['changepass']))
  {
    $newpassword=md5($_POST['newpass']);
    //echo"$newpassword";
    $sql3="UPDATE studenttable SET user_pass=:newpassword WHERE user_id=:useId";
    $query3=$dbh->prepare($sql3);
    $query3->bindParam('useId',$useId,PDO::PARAM_STR);
    $query3->bindParam('newpassword',$newpassword,PDO::PARAM_STR);
    $query3->execute();
    echo"<script type='text/javascript'>alert('password changed')</script>";
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

  table{
    margin-top: 5%;
    text-align: center;
  }
  .head1{
    position: relative;;
    left:25%;
    width:50%;
    margin-top: 100px;
  }  table {
    border-collapse: collapse;
    width: 40%;
  }

td
{
  padding: 8px;
}

  tr:nth-child(even){background-color: #f2f2f2}

  th {
    padding: 8px;
    background-color:#80ced6 ;
    color: white;
  }

  .sub{
      position: relative;
      background-color:  #80ced6;
      border: none;
      width: 20%;

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
      Dashboard
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

<form method="post">
<table align="center" border="1px">
<tr>
  <th colspan="2">
  <h2>
    <?php
     $sql1="SELECT name FROM userinfo WHERE user_id=:useId";
     $query1=$dbh->prepare($sql1);
     $query1->bindParam('useId',$useId,PDO::PARAM_STR);
     $query1->execute();
     $result1=$query1->fetchAll(PDO::FETCH_OBJ);
     foreach ($result1 as $result01) {
       $username=$result01->name;
     }
     echo htmlentities($username);
   ?>
 </h2></th>
</tr>

  <tr>
    <td>New Password</td>


  <td><input type="password" name="newpass"></td>
</tr>
<tr>
  <td colspan="2"><h2><input type="submit" name="changepass" class="sub"></h2></td>
</tr>
</table>
</form>

</body>
  </html>
<?php } ?>
