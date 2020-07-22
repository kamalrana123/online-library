<?php
session_start();
error_reporting(0);
include('include/config.php');
if(strlen($_SESSION['login'])==0)
{
  echo "<script type='text/javascript'>alert('login first');</script>";
  echo "<script type='text/javascript>document.location='login1.php';</script>'";
}
else {
  $loginVarName=$_SESSION['login'];
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

    </style>
    <style>
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
  background-color: #4CAF50;
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
      issued books
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
    <table border="1px"align="center"style="margin-top:10%">
      <tr>
        <th>
          s.no
        </th>
        <th>
          BOOK NAME
        </th>
        <th>
          Date of issue
        </th>
        <th>
          Date of return
        </th>
      </tr>

<?php
$sql="SELECT bookiddetail.name,transactiontable.dateOfIssue,transactiontable.dateOfReturn FROM transactiontable join bookiddetail ON transactiontable.book_id=bookiddetail.book_id WHERE transactiontable.user_id=:loginVarName";
$query=$dbh->prepare($sql);
$query->bindParam('loginVarName',$loginVarName,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
//$resultss=$query->rowCount();
//echo "$resultss";
$cnt=1;
//echo"$cnt";
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
    </tr>

<?php $cnt=$cnt+1; } ?>
</table>
<?php } ?>
</body>
</html>
