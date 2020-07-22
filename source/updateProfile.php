<?php
session_start();
error_reporting(0);
include('include/config.php');
if(strlen($_SESSION['login'])==0)
{
  echo"<script type='text/javascript'> aler('login first'); </script>";
  echo"<script type='text/javascript'> document.location='login1.php'; <script>";
}
else {
  $userId=$_SESSION['login'];
  if(isset($_POST['update']))
  {
    $name=$_POST['name'];
    $email=$_POST['email'];
    $course=$_POST['course'];
    $roll=$_POST['roll'];
    $semester=$_POST['semester'];
    $userId=$_POST['userId'];
    //echo"$name";
    //echo"$email";
    //echo"$course";
    //echo"$roll";
    //echo"$semester";
    //echo"$userId";
    $sql1="UPDATE userinfo SET roll_no=:roll, name=:name, course=:course, semester=:semester, email=:email WHERE user_id=:userId";
    $query1=$dbh->prepare($sql1);
    $query1->bindParam(':roll',$roll,PDO::PARAM_STR);
    $query1->bindParam(':name',$name,PDO::PARAM_STR);
    $query1->bindParam(':course',$course,PDO::PARAM_STR);
    $query1->bindParam(':semester',$semester,PDO::PARAM_STR);
    $query1->bindParam(':email',$email,PDO::PARAM_STR);
    $query1->bindParam(':userId',$userId,PDO::PARAM_STR);
    if($query1->execute())
    {
      echo "string";
    }
    echo"<script type=text/javascript>alert('updated');</script>";
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
  border: 1px solid black;
width: 30%;
height:50%;
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
td{
  text-align: center;
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
    update profile
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
  $sql="SELECT roll_no,user_id,name,course,semester,email FROM userinfo WHERE user_id=:userId";
  $query=$dbh->prepare($sql);
  $query->bindParam('userId',$userId,PDO::PARAM_STR);
  $query->execute();
  $result=$query->fetchAll(PDO::FETCH_OBJ);
  foreach ($result as $results) {
   ?>
  <form method="post">
    <table align="center" name="updateTable">
      <tr>
        <td>
          <label>
            USER ID
          </label>
        </td>
        <td>
          <input type="text" name="userId" value="<?php echo htmlentities($results->user_id); ?>" readonly>
        </td>
      </tr>
      <tr>
        <td>
          <label>
            name
          </label>
        </td>
        <td>
          <input type="text" name="name" value="<?php echo htmlentities($results->name); ?>">
        </td>
      </tr>
      <tr>
        <td>
          <label>
            Roll no
          </label>
        </td>
        <td>
          <input type="text" name="roll" value="<?php echo htmlentities($results->roll_no); ?>" readonly>
        </td>
      </tr>
      <tr>
        <td>
          <label>
            course
          </label>
        </td>
        <td>
          <input type="text" name="course" value="<?php echo htmlentities($results->course); ?>">
        </td>
      </tr>
      <tr>
        <td>
          <label>
            email
          </label>
        </td>
        <td>
          <input type="text" name="email" value="<?php echo htmlentities($results->email); ?>">
        </td>
      </tr>
      <tr>
        <td>
          <label>
            semester
          </label>
        </td>
        <td>
          <input type="text" name="semester" value="<?php echo htmlentities($results->semester); ?>">
        </td>
      </tr>
      <td colspan="2">

      <input type ="submit" name="update" value="update details" class="btn">
      </td>
    </tr>
  </table>
  </form>
<?php } ?>
<?php } ?>
</body>
    </html>
