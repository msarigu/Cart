<?php
session_start();
if(!isset($_SESSION['user_id']))
  {
    require('login_tools.php');
    load();
  }
$page_title='Shop';
include ('C:\xampp\htdocs\Progetti_PHP\includes\header.html');
require ('C:\xampp\htdocs\connect_db_shop.php');
$q="SELECT * FROM shop";
$r=mysqli_query($dbc,$q);
if(mysqli_num_rows($r)>0)
  {
    echo '<table><tr>';
    while($row = mysqli_fetch_array($r , MYSQLI_ASSOC))
      {
        echo'
              <td><strong>'.$row['item_name'].'</strong><br>'
                              .$row['item_descr'].'<br>
                  <img src='  .$row['item_img'].'><br>'
                              .$row['item_price'].'<br>
      <a href="added_shop.php?id=' .$row['id_item'].'"> Add To cart </a></td>';
      }
  }
else {
      echo
      '<p>There are currently no items in this shop. </p>';
}

    echo '</tr></table>';
    mysqli_close($dbc);
    echo
   '<p>
    <a href="cart_shop.php"> View Cart </a> ¦
    <a href="post_forum.php"> Forum </a> ¦
    <a href="home.php"> Home </a> ¦
    <a href="goodbye_shop.php"> Logout </a>
    </p>';
    include ('C:\xampp\htdocs\Progetti_PHP\includes\footer.html');
?>
</body>
</html>
