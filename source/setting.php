<?php
session_start();
error_reporting(0);
include('include/config.php');
if(strlen($_SESSION['login'])==0)
{
  echo"<script type='text/javascript'>alert('login first');</scipt>";
  echo"<script type='text/javascript'>document.location='login1.php';</script>";
}
else {
  $userId=$_SESSION['login'];
  //echo"$userId";
  if(isset($_POST['submit']))
  {
    $passs=md5($_POST['password']);
    $newPass=md5($_POST['pass']);
    $sql1="SELECT * FROM studenttable WHERE user_id=:userId AND user_pass=:passs";
    $query1=$dbh->prepare($sql1);
    $query1->bindParam('userId',$userId,PDO::PARAM_STR);
    $query1->bindParam('passs',$passs,PDO::PARAM_STR);
    $query1->execute();
    $row=$query1->rowCount();
    //echo"$row";
    if($row>0)
    {
      $sql2="UPDATE studenttable SET user_pass=:newPass WHERE user_id=:userId ";
      $query2=$dbh->prepare($sql2);
      $query2->bindParam('newPass',$newPass,PDO::PARAM_STR);
      $query2->bindParam('userId',$userId,PDO::PARAM_STR);
      $query2->execute();    }
    else {
      echo "<script type='text/javascript'>alert('old Password is wrong');</script>";
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
  border: 1px solid black;
width: 30%;
height:40%;
margin-top: 10%;
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
td
{
  text-align: center;
}
</style>
    <script>
    function validatePass() {

			var pass = document.forms["updateform"]["pass"].value;
			var repass = document.forms["updateform"]["repass"].value;
			if (pass!=repass) {
				alert("password do not match");
				return false;
			}
		}
  function openNav() {
    document.getElementById("mySidenav").style.width = "250px";
  }

  function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
  }
  </script>
    <title>
      setting
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
    $sql="SELECT user_id,user_pass FROM studenttable WHERE user_id=:userId";
    $query=$dbh->prepare($sql);
    $query->bindParam('userId',$userId,PDO::PARAM_STR);
    $query->execute();
    //$total=$query->rowCount();
    echo"$total";
    $results=$query->fetchAll(PDO::FETCH_OBJ);
    foreach($results as $result) {
    //  $password=$result->user_pass;
    }
     ?>
     <div onsubmit="return validatePass()" class="updateform">
    <form method="POST" name="updateform">
      <table align="center">
        <tr>
          <td>
          <label>
            userId
          </label>
        </td>
        <td>
          <label>
            <?php echo htmlentities($result->user_id); ?>
          </label>
          </td>
        </tr>
        <tr>
          <td>
          <label>
            Enter Old Password
          </label>
        </td>
        <td>
          <input type="password" name="password" >
        </td>
        </tr>
        <tr>
          <td>
            <label>
              Enter New Password
            </label>
          </td>
          <td>
            <input type="password" name="pass">
          </td>
        </tr>
        <tr>
          <td>
            <label>
              Re Enter Password
            </label>
          </td>
          <td>
            <input type="password" name="repass">
          </td>
        </tr>
        <tr>
          <td colspan="2">
          <input type="submit" name="submit" value="save" class="btn">
        </td>
        </tr>
      </table>
    </form>
  </div>
  </body>
</html>
<?php  } ?>
