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

  if(isset($_POST['addbook']))
  {
    //echo"hello";

    $bookname=$_POST['name'];
    $bookid=$_POST['bookid'];
    $authorid=$_POST['author'];
    $edition=$_POST['edition'];
    $totbooks=$_POST['totalbook'];
    //echo"$bookname";
    //echo"$bookid";
    //echo"$authorid";
    //echo"$edition";
    $sql3="SELECT * FROM bookiddetail WHERE name=:bookname, author_id=:authorid, edition=:edition";
    $query3=$dbh->prepare($sql3);
    $query3->bindParam(':authorid',$authorid,PDO::PARAM_STR);
    $query3->bindParam(':bookname',$bookname,PDO::PARAM_STR);
    $query3->bindParam(':edition',$edition,PDO::PARAM_STR);
    $query3->execute();
    $query3->fetchAll(PDO::FETCH_OBJ);
    $rowcount=$query3->rowCount();
    if($rowcount>0)
    {
      echo"<script type='text/javascript'>alert('Can not Add Book');</script>";
    }
    else {

      $sql4="SELECT * FROM bookiddetail WHERE book_id=:bookid";
      $query4=$dbh->prepare($sql4);
      $query4->bindParam('bookid',$bookid,PDO::PARAM_STR);
      $query4->execute();
      $query4->fetchAll(PDO::FETCH_OBJ);
      if($query4->rowCount()>0)
      {
        echo"<script type='text/javascript'>alert('Please change Book Id');</script>";
      }
      else {


    $sql1="INSERT INTO bookiddetail(book_id,name,author_id,totalbooks) VALUES(:bookid,:bookname,:authorid,:totbooks)";
    $query2=$dbh->prepare($sql1);
    $query2->bindParam(':bookid',$bookid,PDO::PARAM_STR);
    $query2->bindParam(':authorid',$authorid,PDO::PARAM_STR);
    $query2->bindParam(':bookname',$bookname,PDO::PARAM_STR);
    $query2->bindParam(':totbooks',$totbooks,PDO::PARAM_STR);

    $query2->execute();
    $sql2="INSERT INTO bookdetail(book_id,author_id,edition,Number_of_books) VALUES(:bookid,:authorid,:edition,:totbooks)";
    $query1=$dbh->prepare($sql2);
    $query1->bindParam(':bookid',$bookid,PDO::PARAM_STR);
    $query1->bindParam(':authorid',$authorid,PDO::PARAM_STR);
    $query1->bindParam(':edition',$edition,PDO::PARAM_STR);
    $query1->bindParam(':totbooks',$totbooks,PDO::PARAM_STR);
    $query1->execute();
    echo"<script type='text/javascript'>alert('Book Added');</script>";
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
    margin-top: 5%;
    position: relative;
    width:30%;
  left: 35%;
  border: 1px solid #33ccff;
  }
  .head12{
    background-color: #80ced6;
    border: 1px solid #33ccff;
    height:5%;
  }
  .inbox input{
    margin-left: 5%;
    width:90%;
  }
  select{
    margin-left: 5%;
    width: 90%;
    height:4%;
  }
  label{
    margin-left: 5%;
  }
  .cont
  {
    margin-top: 10px;
    position:relative;;
    width:50%;
    left:25%;
  }
  .button {
  background-color:#80ced6 ;
  border: none;
  color: white;
  padding: 16px 32px;
  text-align: center;
  font-size: 16px;
  margin: 4px 2px;
  transition-duration: 0.4s;
  cursor: pointer;
  margin-left: 40%;
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
      add book
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
    <div class="cont">
      <h3>Add Book</h3>
      <hr>
    </div>
      <form method="post" class="form1" name="addbook">
        <div class="head1">
          <div class="head12">
         Book info
       </div>
         <br>
         <div class="inbox">
      <label> Book Name</label>
      <input type="text"name="name" required autocomplete="off">
      <label> Author</label>

      <select name="author">
        <option value="">select</option>
        <?php
          $sql="SELECT * FROM authordetail";
          $query=$dbh->prepare($sql);
          $query->execute();
          $results=$query->fetchAll(PDO::FETCH_OBJ);
          $cnt=1;
          if($query->rowCount() > 0)
          {
            foreach($results as $result)
            {               ?>
              <option value="<?php echo htmlentities($result->author_id);?>"><?php echo htmlentities($result->author_name);?></option>
            <?php }} ?>
      </select>
      <label> Book Id</label>

      <input  type="text" name="bookid" required>
      <label> Edition</label>

      <input type="text" name="edition" required>
      <br>
      <label>
        Totalbooks
      </label>
      <input type="text" name="totalbook" required>
      <br>

    </div>
      <input type="submit" name="addbook" value="submit" class="button">
    </div>
    </form>

  </body>
  </html>


<?php } ?>
