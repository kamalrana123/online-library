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
  if(isset($_POST['submit']))
  {
    $userId=$_POST['useid'];
    $bookid=$_POST['bokid'];
    $doi=$_POST['issuedate'];
    $dor=$_POST['returndate'];
    $adminId=$_SESSION['adminform'];
    $sql3="SELECT * FROM transactiontable WHERE user_id=:userId AND book_id=:bookid";
    $query3=$dbh->prepare($sql3);
    $query3->bindParam(':userId',$userId,PDO::PARAM_STR);
    $query3->bindParam(':bookid',$bookid,PDO::PARAM_STR);
    $query3->execute();
    $query3->fetchAll(PDO::FETCH_OBJ);
    if($query3->rowCount() > 0)
    {
      echo"<script type='text/javascript'>alert('book already issued to this user');</script>";
    }

    else {
      $sql8="SELECT Number_of_books from bookdetail WHERE book_id=:bookid";
      $query8=$dbh->prepare($sql8);
      $query8->bindParam(':bookid',$bookid,PDO::PARAM_STR);
      $query8->execute();
      $result8=$query8->fetchAll(PDO::FETCH_OBJ);
      foreach($result8 as $res8)
      {
        $totbook=$res8->Number_of_books;
      }
      if($totbook>0)
      {
        $totbook=$totbook-1;
        $sql9="UPDATE bookdetail SET Number_of_books=:totbook WHERE book_id=:bookid";
        $query9=$dbh->prepare($sql9);
        $query9->bindParam('totbook',$totbook,PDO::PARAM_STR);
        $query9->bindParam('bookid',$bookid,PDO::PARAM_STR);
        $query9->execute();

    $sql1="INSERT INTO transactionrecord(user_id,book_id,dateOfIssue,adminId) VALUES(:userId,:bookid,:doi,:adminId)";
    $query1=$dbh->prepare($sql1);
    $query1->bindParam('userId',$userId,PDO::PARAM_STR);
    $query1->bindParam('bookid',$bookid,PDO::PARAM_STR);
    $query1->bindParam('doi',$doi,PDO::PARAM_STR);
    $query1->bindParam('adminId',$adminId,PDO::PARAM_STR);
    $res1=$query1->execute();
    $sql2="INSERT INTO transactiontable(user_id,book_id,dateOfIssue,dateOfReturn) VALUES(:userId,:bookid,:doi,:dor)";
    $query2=$dbh->prepare($sql2);
    $query2->bindParam('userId',$userId,PDO::PARAM_STR);
    $query2->bindParam('bookid',$bookid,PDO::PARAM_STR);
    $query2->bindParam('doi',$doi,PDO::PARAM_STR);
    $query2->bindParam('dor',$dor,PDO::PARAM_STR);
    $res2=$query2->execute();
    if($res1=='1' && $res2=='1')
    {
      echo"<script type='text/javascript'>alert('Book Issued');</script>";
    }
    else {
      echo"<script type='text/javascript'>alert('Can not Issue');</script>";
    }
  }
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
    <style>

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
  .form{
    margin-top: 5%;
    position: relative;
    left:30%;
    border:1px solid #33ccff;
    width:40%;
  }
  input{
    position: relative;
    width: 80%;
    left:10%;

  }
  label
  {
        position: relative;
        left:10%;

  }
  .uphead{
    position: relative;
    left:25%;
    width:50%;
    margin-top: 5%;
  }
  .sub{
    position: relative;
    left: 45%;
    background-color:  #80ced6;
    border: none;
    width:10%;
  }
  .formhead
  {
    border:1px solid #33ccff;
      background-color:  #80ced6;
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
      manage issued books
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
  <h4>Issue Book</h4>
  <hr>
</div>
<div class="form">
  <div class="formhead">
    Issue New Book
  </div>
<form method="post" class="form1">
  <div class="part1">

<label>Enter User Id</label>
<br>
  <input type="text" name="useid" required>
  <br>
<label>Enter Book Id</label>
<br>
  <input type="text" name="bokid" required>
<br>
  <label>Issue Date</label>
<br>
  <input type="date" name="issuedate" required>
<br>
<label>Return Date</label>
<br>
  <input type="date" name="returndate" required>
<br>
</div>
<div class="part2">
  <input type="submit" name="submit" class="sub" vlaue="ISSUE">
</div>

</form>
</div>
</body>
</html>
<?php } ?>
