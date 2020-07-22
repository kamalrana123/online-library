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
  if(isset($_GET['del']))
  {
    $id=$_GET['del'];
    echo"$id";
    $sql2="DELETE FROM authordetail WHERE authordetail.author_id=:id";
    $query2=$dbh->prepare($sql2);
    $query2->bindParam(':id',$id,PDO::PARAM_STR);
    $query2->execute();
      }
 ?>
 <!DOCTYPE>
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
 .delete
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
.searchhead
{
  position: relative;
  left: 60%;
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
   <form method="post" class="searchhead">
     <label>search</label>
     <input type="text" name="search" placeholder="author name">
     <input type="submit" name="searchsub" value="search">
   </form>
   <?php
if(isset($_POST['searchsub']))
{
  $authorname=$_POST['search'];
  ?>

  <table align="center">
    <th>
      S.NO
    </th>
    <th>
      Author Id
    </th>
    <th>
      Author Name
    </th>
    <th>
    Action
  </th>
  <?php
  //echo "$authorname";
  $sql3="SELECT * FROM authordetail WHERE author_name=:authorname";
  $query3=$dbh->prepare($sql3);
  $query3->bindParam('authorname',$authorname,PDO::PARAM_STR);
  $query3->execute();
  $result3=$query3->fetchAll(PDO::FETCH_OBJ);
  $cnt=1;
  foreach($result3 as $res3)
  {
   ?>
  <tr>
    <td>
      <?php echo htmlentities($cnt); ?>
    </td>
    <td>
      <?php echo htmlentities($res3->author_id); ?>
    </td>
    <td>
      <?php echo htmlentities($res3->author_name); ?>
    </td>

    <td>
      <a href="admineditauthor.php?authorid=<?php echo htmlentities($res3->author_id); ?>"><button class="edit">Edit</button></a>
      <a href="adminmanageauthor.php?del=<?php echo htmlentities($res3->author_id) ?>" onclick="return confirm('Are you sure you want to delete?')"><button class="delete">Delete</button></a>
    </td>
  </tr>
<?php $cnt=$cnt+1; } ?>
  </table>

<?php } else { ?>
   <table align="center">
     <th>
       S.NO
     </th>
     <th>
       Author Id
     </th>
     <th>
       Author Name
     </th>
     <th>
     Action
   </th>
   <?php
   $sql1="SELECT * FROM authordetail";
   $query1=$dbh->prepare($sql1);
   $query1->execute();
   $result1=$query1->fetchAll(PDO::FETCH_OBJ);
   $cnt=1;
   foreach($result1 as $res1)
   {
    ?>
   <tr>
     <td>
       <?php echo htmlentities($cnt); ?>
     </td>
     <td>
       <?php echo htmlentities($res1->author_id); ?>
     </td>
     <td>
       <?php echo htmlentities($res1->author_name); ?>
     </td>

     <td>
       <a href="admineditauthor.php?authorid=<?php echo htmlentities($res1->author_id); ?>"><button class="edit">Edit</button></a>
       <a href="adminmanageauthor.php?del=<?php echo htmlentities($res1->author_id) ?>" onclick="return confirm('Are you sure you want to delete?')"><button class="delete">Delete</button></a>
     </td>
   </tr>
 <?php $cnt=$cnt+1; } ?>
   </table>
 <?php } ?>
 </body>
</html>
<?php } ?>
