<?php
session_start();
if (!isset($_SESSION['user_id']))
  {
    require('login_tools.php');
    load();
  }

echo "<h1>HOME</h1>
<p>You are logged in :
{$_SESSION['first_name']} {$_SESSION['last_name']}
</p>";

echo '<p>
<a href="post.php"> Post Messagge </a> ¦
<a href="post_forum.php"> Forum </a> ¦
<a href="shop.php"> Shop </a> ¦
<a href="home.php"> Home </a> ¦
<a href="Goodbye.php"> Logout </a>
</p>';

include ('C:\xampp\htdocs\Progetti_PHP\includes\footer.html');

?>
