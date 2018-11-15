<?php
session_start();
if(!isset($_SESSION['user_id']))
  {
    require('login_tools.php');
    load();
  }

  $page_title='Cart Addition';
  include ('C:\xampp\htdocs\Progetti_PHP\includes\header.html');
  if(isset($_GET['id'])) $id = $_GET['id'];
  require ('C:\xampp\htdocs\connect_db_shop.php');

  $q = "SELECT * FROM shop WHERE id_item=$id";
  $r = mysqli_query($dbc,$q);
  if (mysqli_num_rows($r) == 1)
    {
      $row = mysqli_fetch_array($r , MYSQLI_ASSOC);
      if (isset($_SESSION['cart'][$id]))
        {
          $_SESSION['cart'][$id]['quantity'] ++;
          echo '<p> Another '. $row["item_name"].
          ' has been added to your cart</p>';
        }
      else
        {
          $_SESSION['cart'][$id]=array ('quantity' => 1, 'price' => $row['item_price']);
          echo '<p> A '.$row["item_name"].
          ' has been added to your cart</p>';
        }
    }
mysqli_close($dbc);

echo
'<p>
<a href="shop.php"> Shop </a> ¦
<a href="cart_shop.php"> View Cart </a> ¦
<a href="post_forum.php"> Forum </a> ¦
<a href="home.php"> Home </a> ¦
<a href="goodbye_shop.php"> Logout </a>
</p>';
include ('C:\xampp\htdocs\Progetti_PHP\includes\footer.html');
 ?>