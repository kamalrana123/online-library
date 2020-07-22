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
  if(isset($_GET['userId']))
  {
    $id=$_GET['userId'];
    //echo"$id";
    $sql3="SELECT status FROM userinfo WHERE user_id=:id";
    $query3=$dbh->prepare($sql3);
    $query3->bindParam('id',$id,PDO::PARAM_STR);
    $query3->execute();
    $result3=$query3->fetchAll(PDO::FETCH_OBJ);
    foreach ($result3 as $result03) {
      $uidstatus=$result03->status;
    }
    if($uidstatus=='1')
    {
    $sql2="UPDATE userinfo SET status='0' WHERE user_id=:id";
    $query2=$dbh->prepare($sql2);
    $query2->bindParam(':id',$id,PDO::PARAM_STR);
    $query2->execute();

    $sql4="UPDATE studenttable SET status='0' WHERE user_id=:id";
    $query4=$dbh->prepare($sql4);
    $query4->bindParam(':id',$id,PDO::PARAM_STR);
    $query4->execute();
  }
  else
  {
    $sql5="UPDATE userinfo SET status='1' WHERE user_id=:id";
  $query5=$dbh->prepare($sql5);
  $query5->bindParam(':id',$id,PDO::PARAM_STR);
  $query5->execute();

  $sql6="UPDATE studenttable SET status='1' WHERE user_id=:id";
  $query6=$dbh->prepare($sql6);
  $query6->bindParam(':id',$id,PDO::PARAM_STR);
  $query6->execute();

  }
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

.search
{
  position: relative;
  left:65%
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
     Manage User
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
   <form method="post" class="search">
     <label> search</label>
     <input type="text" name="userId" placeholder="User Id">
     <input type="submit" name="searchsub" value="search">
     </form>
     <?php
     if(isset($_POST['searchsub']))
     {
       ?>
       <table align="center">
         <th>
           S.NO
         </th>
         <th>
           Student Id
         </th>
         <th>
           Student Name
         </th>
         <th>
           status
       </th>
       <th>
         Action
       </th>
       <?php
       $ussid=$_POST['userId'];
       $sql8="SELECT * FROM userinfo WHERE user_id=:ussid";
       $query8=$dbh->prepare($sql8);
       $query8->bindParam('ussid',$ussid,PDO::PARAM_STR);
       $query8->execute();
       $result8=$query8->fetchAll(PDO::FETCH_OBJ);
       $cnt=1;
       foreach($result8 as $res8)
       {
        ?>
       <tr>
         <td>
           <?php echo htmlentities($cnt); ?>
         </td>
         <td>
           <?php echo htmlentities($res8->user_id); ?>
         </td>
         <td>
           <?php echo htmlentities($res8->name); ?>
         </td>
         <td>
           <?php
            if($res8->status=='1')
            {
              echo "Active";
            }
            else {
              echo"Inactive";
            }
            ?>
         </td>
         <td>
           <a href="adminmanageuser.php?userId=<?php echo htmlentities($res8->user_id); ?>"><button class="edit"><?php
           if($res8->status=='1')
           {
             echo "Inactive";
           }
           else {
             echo"Active";
           }
           ?>
            </button></a>
           <a href="adminuserchangepassword.php?userId=<?php echo htmlentities($res8->user_id); ?>"><button class="delete">Change Password</button></a>
         </td>
       </tr>
     <?php $cnt=$cnt+1; } ?>
       </table>
    <?php }else { ?>

   <table align="center">
     <th>
       S.NO
     </th>
     <th>
       Student Id
     </th>
     <th>
       Student Name
     </th>
     <th>
       status
   </th>
   <th>
     Action
   </th>
   <?php
   $sql1="SELECT * FROM userinfo";
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
       <?php echo htmlentities($res1->user_id); ?>
     </td>
     <td>
       <?php echo htmlentities($res1->name); ?>
     </td>
     <td>
       <?php
        if($res1->status=='1')
        {
          echo "Active";
        }
        else {
          echo"Inactive";
        }
        ?>
     </td>
     <td>
       <a href="adminmanageuser.php?userId=<?php echo htmlentities($res1->user_id); ?>"><button class="edit"><?php
       if($res1->status=='1')
       {
         echo "Inactive";
       }
       else {
         echo"Active";
       }
       ?>
        </button></a>
       <a href="adminuserchangepassword.php?userId=<?php echo htmlentities($res1->user_id); ?>"><button class="delete">Change Password</button></a>
     </td>
   </tr>
 <?php $cnt=$cnt+1; } ?>
   </table>
 <?php } ?>
 </body>
</html>
<?php } ?>
