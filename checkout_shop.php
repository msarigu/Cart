<?php
session_start();
if(!isset($_SESSION['user_id']))
  {
    require('login_tools.php');
    load();
  }
$page_title = "Checkout";
include ('C:\xampp\htdocs\Progetti_PHP\includes\header.html');

if(isset($_GET['total']) AND ($_GET['total']>0) AND (!empty($_SESSION['cart'])))
  {
    require ('C:\xampp\htdocs\connect_db_shop.php');

    $q= "INSERT INTO orders (user_id , total , order_date)
        VALUES (" .$_SESSION['user_id'].",".$_GET['total']." , NOW() )";
    $r = mysqli_query($dbc,$q);
    $order_id = mysqli_insert_id($dbc);
    $q = "SELECT * FROM shop WHERE id_item IN (";
    foreach ($_SESSION['cart'] as $id => $value)
      {$q .=$id.',';}
    $q = substr($q , 0 , -1).") ORDER BY id_item ASC";
    $r = mysqli_query($dbc , $q);

    while ($row = mysqli_fetch_array ($r , MYSQLI_ASSOC))
      {
        $query =  "INSERT INTO order_contents (order_id , id_item , quantity , price)
                  VALUES ($order_id , " .$row['id_item'].",".
                  $_SESSION['cart'][$row['id_item']]['quantity'].",".
                  $_SESSION['cart'][$row['id_item']]['price'].")";
        $result = mysqli_query($dbc , $query);
      }
    mysqli_close($dbc);
    echo "<p> Thanks for your order.
              Your order Number is #".$order_id."</p>";
    $_SESSION['cart'] = NULL;
  }
else {
        echo '<p> There are no items in your cart.</p>';
    }

        echo
        '<p>
        <a href="shop.php"> Shop </a> ¦
        <a href="post_forum.php"> Forum </a> ¦
        <a href="home.php"> Home </a> ¦
        <a href="goodbye_shop.php"> Logout </a>
        </p>';
        include ('C:\xampp\htdocs\Progetti_PHP\includes\footer.html');
 ?>
