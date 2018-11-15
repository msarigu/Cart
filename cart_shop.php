<?php
session_start();
if(!isset($_SESSION['user_id']))
  {
    require('login_tools.php');
    load();
  }
$page_title = "Cart";
include ('C:\xampp\htdocs\Progetti_PHP\includes\header.html');

if($_SERVER['REQUEST_METHOD'] == 'POST')
  {
    foreach($_POST['qty'] as $item_id => $item_qty)
      {
        /*Ensure values are integers*/
        $id = (int) $item_id;
        $qty = (int) $item_qty;

        /*change quantity or delete if zero*/
        if ($qty == 0)
          { unset($_SESSION['cart'][$id]);}
        elseif ($qty>0)
          { $_SESSION['cart'][$id]['quantity'] = $qty;}
      }
  }
$total = 0;
if(!empty($_SESSION['cart']))
  {
    require ('C:\xampp\htdocs\connect_db_shop.php');
    $q = "SELECT * FROM shop WHERE id_item IN (";
    foreach ($_SESSION['cart'] as $id => $value)
      {$q .= $id .',';}
    $q = substr($q , 0 , -1).") ORDER BY id_item ASC";
    $r = mysqli_query ($dbc , $q);

    echo ' <form action ="cart_shop.php" method="POST">
    <table><tr><th colspan="5"> Items in your Cart</th></tr><tr>';

    while ($row = mysqli_fetch_array ($r , MYSQLI_ASSOC))
      {
        $subtotal= $_SESSION['cart'][$row['id_item']]['quantity']
          * $_SESSION['cart'][$row['id_item']]['price'];
        $total += $subtotal;

        echo " <tr> <td> Pizza  {$row['item_name']}</td>
        <td><input type=\"text\"size=\"3\"
        name=\"qty[{$row['id_item']}]\"
        value=\"{$_SESSION['cart'][$row['id_item']]['quantity']}\">
        </td><td> x  {$row['item_price']} = </td>
        <td>".number_format($subtotal , 2). "</td></tr>";
      }
    echo '<tr><td colspan="5">
    Total='.number_format($total , 2).'</td></tr>
    </table>
    <input type = "submit" value="Update My Cart">
    </form>';
    mysqli_close($dbc);
  }
  else
    {echo '<p> Your cart is currently empty.</p>';}

    echo "$total";
    echo
    '<p>
    <a href="shop.php"> Shop </a> ¦
    <a href="checkout_shop.php"> Checkout </a> ¦
    <a href="post_forum.php"> Forum </a> ¦
    <a href="home.php"> Home </a> ¦
    <a href="oodbye_shop.php"> Logout </a>
    </p>';
    include ('C:\xampp\htdocs\Progetti_PHP\includes\footer.html');
 ?>
