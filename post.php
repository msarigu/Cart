<?php
session_start ();
if (!isset($_SESSION['user_id']))
  {
    require ('login_tools.php');
    load();
  }
$page_title = 'Post Messagge';
include ('C:\xampp\htdocs\Progetti_PHP\includes\header.html');

?>
<form action = "post_action.php" method="POST" accept-charset="utf-8">

<p> Sucject:<br>
<input name = "subject" type="text" size="64"></p>

<p> Messagge:<br>
<textarea name="messagge" rows="5" cols="50"></textarea></p>

<p><input type="submit" value="Submit"></p>
</form>

<p>
<a href="post_forum.php"> Forum </a> ¦
<a href="shop.php"> Shop </a> ¦
<a href="home.php"> Home </a> ¦
<a href="Goodbye.php"> Logout </a>
</p>

<?php
include ('C:\xampp\htdocs\Progetti_PHP\includes\footer.html');
 ?>
