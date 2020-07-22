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
     Book Issued
   </title>
 </head>

 <body>
   <ul>
     <li class="webName"><a class="active" href="#home">Library management system</a>  <div id="mySidenav" class="sidenav">
      <?php include_once('include/sidenav.php') ?>
     </div>
     <span style="font-size:30px;cursor:pointer;color:white" onclick="openNav()">&#9776; </span></li>
     <li><a href="adminlogout.php">logout</a></li>
     <li><a href="adminchangepassword.php">Change password</a></li>
   </ul>
   <table border="1px"align="center"style="margin-top:4%">
     <th>
       S.no
     </th>
     <th>
       Transaction ID
     </th>
     <th>
       Book ID
     </th>
     <th>
      User ID
     </th>
     <th>
       Book Name
     </th>
   <?php
   $sql="SELECT transactiontable.transaction_id,transactiontable.user_id,transactiontable.book_id,bookiddetail.name FROM transactiontable join bookiddetail ON transactiontable.book_id=bookiddetail.book_id ";
   $query=$dbh->prepare($sql);
   $query->execute();

   $results=$query->fetchAll(PDO::FETCH_OBJ);
   $cnt=1;
   foreach ($results as $result) {
   ?>

     <tr>
       <td>
         <?php echo htmlentities($cnt); ?>
       </td>
       <td>
         <?php echo htmlentities($result->transaction_id); ?>
       </td>
       <td>
         <?php echo htmlentities($result->book_id); ?>
       </td>
       <td>
         <?php echo htmlentities($result->user_id); ?>
       </td>
       <td>
         <?php echo htmlentities($result->name); ?>
       </td>
       <tr>

<?php $cnt=$cnt+1;  } ?>
</table>
 </body>
 </html>
<?php } ?>
