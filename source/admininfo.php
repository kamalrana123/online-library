<?php
session_start();
error_reporting(0);
include('include/config.php');
if(strlen($_SESSION['adminform'])==0)
{
  echo"<script type='text/javascript'>alert('login first')</script>";
  echo"<script type='text/javascript'> document.location='adminlogin.php'; </script>";
}
else
{
  $adminid=$_SESSION['adminform'];
if(isset($_POST['update']))
{
  $name=$_POST['name'];
  $email=$_POST['email'];
  //echo "$name";
  //echo "$email";
  $sql1="UPDATE admininfo SET name=:name, email=:email WHERE adminId=:adminid";
  $query1=$dbh->prepare($sql1);
  $query1->bindParam(':name',$name,PDO::PARAM_STR);
  $query1->bindParam(':email',$email,PDO::PARAM_STR);
  $query1->bindParam(':adminid',$adminid,PDO::PARAM_STR);
  $query1->execute();
}
  ?>
  <!DOCTYPE html>
<html>
<title>
  admin info
</title>

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
  border: 1px solid black;
width: 30%;
height:50%;
margin-top: 5%;
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
td{
  text-align: center;
}
.btn {
  background-color: #4CAF50;
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


  </style>

  <script>
  function openNav() {
    document.getElementById("mySidenav").style.width = "250px";
  }

  function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
  }
  </script>
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
    <?php
  $sql="SELECT * FROM admininfo WHERE adminId=:adminid";
  $query=$dbh->prepare($sql);
  $query->bindParam('adminid',$adminid,PDO::PARAM_STR);
  $query->execute();
  $result=$query->fetchAll(PDO::FETCH_OBJ);
  foreach ($result as $results) {
   ?>
    <form  method="post">


<table align="center" border="1px">
  <tr>
    <th colspan="2">
      <h2>ADMIN<h2>
    </th>
  </tr>
  <tr>
        <td>
          <label>
            Admin Id
          </label>
        </td>
        <td>
          <input type="text" name="userId" value="<?php echo htmlentities($results->adminId); ?>" readonly>
        </td>
      </tr>
      <tr>
        <td>
          <label>
            Name
          </label>
        </td>
        <td>
          <input type="text" name="name" value="<?php echo htmlentities($results->name); ?>"required>
        </td>
      </tr>
      <tr>
        <td>
          <label>
            Email
          </label>
        </td>
        <td>
          <input type="text" name="email" value="<?php echo htmlentities($results->email); ?> "required>
        </td>
      </tr>
      <tr>
      <td colspan="2">

      <input type="submit" name="update" value="update details" class="btn">
      </td>
    </tr>
</table>
    </form>
  <?php } ?>
  </body>

</html>

<?php }  ?>
