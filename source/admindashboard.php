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
    text-align: center;
  }
  .head1{
    position: relative;;
    left:25%;
    width:50%;
    margin-top: 100px;
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
      <li><a href="admininfo.php"> Profile </a></li>
    </ul>
    <div class="head1">
      <h3>Admin Dashboard</h3>
      <hr>
    </div>
    <?php
    $sql="SELECT * FROM studenttable";
    $query=$dbh->prepare($sql);
    $query->execute();

    $totaluser=$query->rowCount();

    $sql2="SELECT * FROM bookiddetail";
    $query2=$dbh->prepare($sql2);
    $query2->execute();
    $totalbook=$query2->rowCount();
    //echo "$total";

    $sql3="SELECT * FROM transactionrecord";
    $query3=$dbh->prepare($sql3);
    $query3->execute();
    $totaltimebookissued=$query3->rowCount();
     ?>
    <table align="center" style="margin-top: 5%;">
      <tr>
        <td>
    <div class="flip-box">
    <div class="flip-box-inner">
      <div class="flip-box-front">
        <h2>TOTAL USERS</h2>
      </div>
      <div class="flip-box-back">
        <h2><?php echo htmlentities($totaluser); ?></h2>
      </div>
    </div>
  </div>
  </td>
  <td>
    <div class="flip-box">
    <div class="flip-box-inner">
      <div class="flip-box-front">
        <h2>TOTAL NO OF BOOKS</h2>
      </div>
      <div class="flip-box-back">
        <h2><?php echo htmlentities($totalbook); ?></h2>
      </div>
    </div>
  </div>
  </td>
  <td>
    <div class="flip-box">
    <div class="flip-box-inner">
      <div class="flip-box-front">
        <h2>ALL TIME BOOK ISSUED</h2>
      </div>
      <div class="flip-box-back">
        <h2><?php echo htmlentities($totaltimebookissued);
       ?></h2>
      </div>
    </div>
  </div>
  </td>
  </tr>
  </table>
</body>
  </html>
<?php } ?>
