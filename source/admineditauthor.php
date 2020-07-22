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
  $authorid=intval($_GET['authorid']);
  //echo "$authorid";
  if(isset($_POST['authedit']))
  {
    $authorname=$_POST['name'];
    //echo "$authorname";
    $sql2="UPDATE authordetail SET author_name=:authorname WHERE authordetail.author_id=:authorid";
    $query2=$dbh->prepare($sql2);
    $query2->bindParam(':authorname',$authorname,PDO::PARAM_STR);
    $query2->bindParam(':authorid',$authorid,PDO::PARAM_STR);
    $query2->execute();
  }
  $sql1="SELECT * FROM authordetail WHERE author_id=:authorid";
  $query1=$dbh->prepare($sql1);
  $query1->bindParam(':authorid',$authorid,PDO::PARAM_STR);
  $query1->execute();
  $result1=$query1->fetchAll(PDO::FETCH_OBJ);
  foreach ($result1 as $res1) {
    ?>

<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/myfile.css">
  <link rel="stylesheet" type="text/css" href="css/myfile3.css">
  <style>
    .form1
    {
      position: relative;
    }
    .head{
      position: relative;
      left: 25%;
      width: 50%;
      margin-top: 100px;
    }
    .form1{
      position: relative;
      left:10%;
      border: 1px solid#33ccff;
      width: 80%;
    }
    .subhead
    {
      position: relative;
      background-color: #80ced6;
      border: 1px solid #33ccff;
    }
    .lab
    {
      position: relative;
      left:20%;
    }
    .inp
    {
      position: relative;
      left:20%;
      width: 60%;
    }
  </style>
  <title>
  </title>
</head>
  <body>
    <div class="head">
      <label>
        <h1>Edit Author Info</h1>
      </label>
      <hr>

      <div class="form1">
      <div class="subhead">
        Author Info
      </div>
      <form class="" method="post">
        <label class="lab">
          Edit Name
        </label>
        <br>
        <input class="inp" type="text" name="name" value="<?php echo  htmlentities($res1->author_name); ?>">
        <br>
        <br>
        <input type="submit" name="authedit" value="update" style="position:relative; left:50%; background-color:#80ced6; border:none;">
      </form>
    </div>
    </div>
  </body>

</html>
  <?php  } ?>
<?php } ?>
