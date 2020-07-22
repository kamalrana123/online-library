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
  $loginVarName=$_SESSION['adminform'];
  $stuid=$_SESSION['stid'];
  if(isset($_GET['bkid']))
  {
    $id=$_GET['bkid'];



    //echo"$id";
    $sql2="DELETE FROM transactiontable WHERE user_id=:stuid and book_id=:id";
    $query2=$dbh->prepare($sql2);
    $query2->bindParam(':stuid',$stuid,PDO::PARAM_STR);
    $query2->bindParam(':id',$id,PDO::PARAM_STR);
    $query2->execute();



    $sql8="SELECT Number_of_books from bookdetail WHERE book_id=:id";
    $query8=$dbh->prepare($sql8);
    $query8->bindParam(':id',$id,PDO::PARAM_STR);
    $query8->execute();
    $result8=$query8->fetchAll(PDO::FETCH_OBJ);
    foreach($result8 as $res8)
    {
      $totbook=$res8->Number_of_books;
    }


      $totbook=$totbook+1;
      $sql9="UPDATE bookdetail SET Number_of_books=:totbook WHERE book_id=:id";
      $query9=$dbh->prepare($sql9);
      $query9->bindParam('totbook',$totbook,PDO::PARAM_STR);
      $query9->bindParam('id',$id,PDO::PARAM_STR);
      $query9->execute();


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
  table {
    border-collapse: collapse;
    width: 60%;
  }

  th, td {
    text-align: left;
    padding: 8px;
  }

  tr:nth-child(even){background-color: #f2f2f2}

  th {
    background-color:#80ced6 ;
    color: white;
  }
  .edit
  {
    background-color: #4CAF50;
      border: none;
      color: white;
      padding: 15px 32px;
      text-align: center;
      text-decoration: none;
      display: inline-block;
      font-size: 16px;
      margin: 4px 2px;
      cursor: pointer;
  }
  .return
  {
    background-color: red;
  border: none;
  color: white;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  cursor: pointer;
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
<div>
  <table border="1px"align="center"style="margin-top:10%">
    <tr>
      <th>
        s.no
      </th>
      <th>
        Book Name
      </th>
      <th>
        Date of issue
      </th>
      <th>
        Date of return
      </th>
      <th>
        Action
      </th>
      <th>
        total Fine
      </th>
    </tr>

<?php
$sql1="SELECT bookiddetail.name,transactiontable.dateOfIssue,transactiontable.dateOfReturn,transactiontable.book_id FROM transactiontable join bookiddetail ON transactiontable.book_id=bookiddetail.book_id WHERE transactiontable.user_id=:stuid";
$query1=$dbh->prepare($sql1);
$query1->bindParam('stuid',$stuid,PDO::PARAM_STR);
$query1->execute();
$results=$query1->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
foreach($results as $result) {
  ?>
      <tr>
      <td>
        <?php echo htmlentities($cnt); ?>
      </td>
      <td>
        <?php echo htmlentities($result ->name); ?>
      </td>
      <td>
        <?php echo htmlentities($result ->dateOfIssue); ?>
      </td>
      <td>
        <?php echo htmlentities($result ->dateOfReturn); ?>
      </td>
      <td>
          <a href="adminreturn.php?bkid=<?php echo htmlentities($result->book_id); ?>" onclick="return confirm('Are you sure you want to return?');"><button class="return">return</button></a>
      </td>

      <td>
        <?php
        if($cnt==1)
        {
        $sql4="SELECT fine FROM finetable WHERE user_id=:stuid";
        $query4=$dbh->prepare($sql4);
        $query4->bindParam('stuid',$stuid,PDO::PARAM_STR);
        $query4->execute();
        $result1=$query4->fetchAll(PDO::FETCH_OBJ);
        foreach ($result1 as $result01) {
          echo htmlentities($result01->fine);
        }
      }
        ?>
      </td>
      </tr>
<?php $cnt=$cnt+1; } ?>

</table>
</div>
</body>
</html>
<?php } ?>
