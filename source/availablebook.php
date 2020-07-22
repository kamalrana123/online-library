<?php
session_start();
error_reporting(0);
include('include/config.php');
if(strlen($_SESSION['login'])==0)
{
  echo"<script type='text/javascript'>alert('login first');</script>";
  echo"<script type='text/javascript'>document.location='login1.php'; </script>";
}
else {
  $loginVarName=$_SESSION['login'];
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
  .subsearch
  {
    position: relative;
    left:60%;
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
  <title>
    Available book
  </title>
  <body>
    <ul>
      <li class="webName"><a class="active" href="#home">Library management system</a>  <div id="mySidenav" class="sidenav">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <a href="dashbord.php"> DASHBOARD </a>
        <a href="issuedBooks.php"> BOOKS ISSUED </a>
          <a href="availablebook.php"> AVAILABLE BOOK </a>
      </div>
      <span style="font-size:30px;cursor:pointer;color:white" onclick="openNav()">&#9776; </span></li>
      <li><a href="logout.php">logout</a></li>
      <li><a href="userprofile.php">User profile</a></li>
      <li><a href="setting.php">Setting</a></li>
    </ul>
    <form method="post" class="subsearch">
      <label>
        search
      </label>
      <input type="text" name="search" placeholder="name">
      <input type="submit" value="search" name="sub">
    </form>
    <?php
      if(isset($_POST['sub']))
      { $bokname=$_POST['search'];
        ?>
        <table align="center" border="1px">
          <th>
            s.no
          </th>
          <th>
            Book Id
          </th>
          <th>
            Book Name
          </th>
          <th>
            Author Name
          </th>
          <th>
            Edition
          </th>


        <?php
          $sql1="SELECT bookdetail.book_id,bookiddetail.name,authordetail.author_name,bookdetail.edition FROM bookdetail join bookiddetail ON bookdetail.book_id=bookiddetail.book_id join authordetail on bookdetail.author_id=authordetail.author_id WHERE bookiddetail.name=:bokname";
          $query1=$dbh->prepare($sql1);
          $query1->bindParam('bokname',$bokname,PDO::PARAM_STR);
          $query1->execute();
          $results1=$query1->fetchAll(PDO::FETCH_OBJ);
          $cnt=1;
          foreach($results1 as $result1)
          {
            ?>
            <tr>
              <td>
                <?php echo htmlentities($cnt); ?>
              </td>
              <td>
                <?php  echo htmlentities($result1->book_id); ?>
              </td>


                <td>
                  <?php  echo htmlentities($result1->name); ?>
                </td>


                  <td>
                    <?php  echo htmlentities($result1->author_name); ?>
                  </td>


                    <td>
                      <?php  echo htmlentities($result1->edition); ?>
                    </td>
                  </div>
              </tr>

        <?php $cnt=$cnt+1; } ?>
    <?php  } else { ?>
    <table align="center" border="1px">
      <th>
        s.no
      </th>
      <th>
        Book Id
      </th>
      <th>
        Book Name
      </th>
      <th>
        Author Name
      </th>
      <th>
        Edition
      </th>

    <?php
      $sql="SELECT bookdetail.book_id,bookiddetail.name,authordetail.author_name,bookdetail.edition FROM bookdetail join bookiddetail ON bookdetail.book_id=bookiddetail.book_id join authordetail on bookdetail.author_id=authordetail.author_id";
      $query=$dbh->prepare($sql);
      $query->execute();
      $results=$query->fetchAll(PDO::FETCH_OBJ);
      $cnt=1;
      foreach($results as $result)
      {
        ?>
        <tr>
          <td>
            <?php echo htmlentities($cnt); ?>
          </td>
          <td>
            <?php  echo htmlentities($result->book_id); ?>
          </td>


            <td>
              <?php  echo htmlentities($result->name); ?>
            </td>


              <td>
                <?php  echo htmlentities($result->author_name); ?>
              </td>


                <td>
                  <?php  echo htmlentities($result->edition); ?>
                </td>

              </div>
          </tr>

    <?php $cnt=$cnt+1; } }?>

</body>
</html>

<?php }  ?>
