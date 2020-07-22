<?php
session_start();
error_reporting(0);
include('include/config.php');
if(strlen($_SESSION['adminform'])==0)
{
  echo"<script type='text/javascript'>alert('login first');</script>";
  echo"<script tyoe='text/javascript'>document.location('login1.php');</script>";
}
else {

  $bookid=intval($_GET['bookId']);
//  echo"$bookid";
  if(isset($_POST['edit']))
  {
    $bookname=$_POST['name'];
    $authorid=$_POST['author'];
    $edition=$_POST['edition'];
    //echo"$bookname";
    //echo"$bookid";
    //echo"$authorid";
    //echo"$edition";
    $sql5="UPDATE bookiddetail SET name=:bookname, author_id=:authorid WHERE book_id=:bookid";
    $query5=$dbh->prepare($sql5);
    $query5->bindParam(':bookname',$bookname,PDO::PARAM_STR);
    $query5->bindParam(':authorid',$authorid,PDO::PARAM_STR);
    $query5->bindParam(':bookid',$bookid,PDO::PARAM_STR);
    $query5->execute();

    $sql6="UPDATE bookdetail SET author_id=:authorid, edition=:edition WHERE book_id=:bookid";
    $query6=$dbh->prepare($sql6);
    $query6->bindParam(':authorid',$authorid,PDO::PARAM_STR);
    $query6->bindParam('edition',$edition,PDO::PARAM_STR);
    $query6->bindParam('bookid',$bookid,PDO::PARAM_STR);
    $query6->execute();



  }
  $sql2="SELECT * FROM bookdetail WHERE book_id=:bookid";
  $query2=$dbh->prepare($sql2);
  $query2->bindParam(':bookid',$bookid,PDO::PARAM_STR);
  $query2->execute();
  $result1=$query2->fetchAll(PDO::FETCH_OBJ);
  $row=$query2->rowCount();
  foreach ($result1 as $res) {
    $auth=$res->author_id;

  ?>
<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/myfile.css">
  <link rel="stylesheet" type="text/css" href="css/myfile3.css">
  <style>
  .head{
    position: relative;;
    left:25%;
    margin-top: 10%;
    width:50%;
  }
  .form{
    position: relative;
    border: 1px solid #33ccff;
    width:30%;
    left: 35%;

  }
  .info
  {
      border-bottom: 1px solid #33ccff;
      background-color:  #80ced6;
  }
  .inp
  {
  position: relative;
    left: 20%;
    margin-top: 10px;
    width:60%
  }
  .btn
  {
    position: relative;
    border: 1px solid #80ced6;
    background-color: #80ced6;
    left: 20%;
  }
  label{
    position: relative;
    left: 20%;
  }
  </style>
  <title>
  </title>
</head>
  <body>
    <div class="head">
      <h3>Edit Book Info</h3>
      <hr>
    </div>
    <div class="form">
      <div class="info">

        Book Info

    </div>
    <?php
    $sql3="SELECT name FROM bookiddetail WHERE book_id=:bookid";
    $query3=$dbh->prepare($sql3);
    $query3->bindParam('bookid',$bookid,PDO::PARAM_STR);
    $query3->execute();
    $result3=$query3->fetchAll(PDO::FETCH_OBJ);
    foreach ($result3 as $res3) {

    ?>


<form method="post">
  <label>Book name</label>
  <br>
  <input class="inp" type="text" name="name"value="<?php echo htmlentities($res3->name); ?> "required>
  <br>
  <br>
  <label>Author</label>
  <br>
  <select name="author" class="inp" style="height:30px;">

<?php
$sql4="SELECT * FROM authordetail WHERE author_id=:auth";
$query4=$dbh->prepare($sql4);
$query4->bindParam('auth',$auth,PDO::PARAM_STR);
$query4->execute();
$result4=$query4->fetchAll(PDO::FETCH_OBJ);
foreach($result4 as $res4) {
  ?>

<option value="<?php echo htmlentities($res4->author_id); ?>"><?php echo htmlentities($res4->author_name); ?> </option>
<?php } ?>
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

<br>
<br>
<label>Edition</label>
<br>
<input class="inp" type="text" name="edition" value="<?php echo htmlentities($res->edition); ?>" required>
<br><br>
<input class="btn" type="submit" name="edit" value="update">
</form>
<?php  } ?>
<?php  } ?>
</div>
  </body>
</html>
<?php } ?>
