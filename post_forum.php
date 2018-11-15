<?php
session_start();
if(!isset($_SESSION['user_id']))
  {
    require('login_tools.php');
    load();
  }

  $page_title='Forum';
  include ('C:\xampp\htdocs\Progetti_PHP\includes\header.html');
  require ('C:\xampp\htdocs\connect_db_forum.php');

  $q="SELECT * FROM forum";
  $r=mysqli_query($dbc, $q);
  if(mysqli_num_rows($r)>0)
    {
      echo'<table border= "3"><tr><th align="left"> Posted By </th>
      <th align="left"> Subject </th>
      <th align="left" id="msg"> Messagge </th></tr>';
      while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC))
        {
          echo '<tr>
          <td>' .$row['first_name'].' '.$row['last_name'].'<br>'.$row['post_date'].'</td>
          <td>' .$row['subject'].'</td><td>'.$row['messagge'].'</td>
          </tr>';
        }
        echo'</table>';
    }
  else {
    echo'<p> There are currently no messagges. </p>';}

    echo '<p>
    <a href="post.php"> Post Messagge </a> ¦
    <a href="shop.php"> Shop </a> ¦
    <a href="home.php"> Home </a> ¦
    <a href="Goodbye.php"> Logout </a>
    </p>';

    mysqli_close($dbc);
    include ('C:\xampp\htdocs\Progetti_PHP\includes\footer.html');

 ?>
