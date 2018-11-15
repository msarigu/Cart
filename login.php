<?php
$page_title = "Login";
include ('C:\xampp\htdocs\Progetti_PHP\includes\header.html');
if (isset($errors) && !empty($errors))
  {echo '<p id="err_msg"<Oops! There was a problem:<br>';
    foreach ($errors as $msg)
      { echo ".$msg<br>";}
    echo 'Please try again  or <a href="register.php">Register</a></p>';
  }

?>
<h1>Login</h1>
<form action = "login_action.php" method="POST">
<p>
Email Address: <input type="text" name="email">
</p><p>
Password: <input type="text" name="pass">
</p><p>
<input type="submit" value="Login">
</p>
</form>

<?php
include ('C:\xampp\htdocs\Progetti_PHP\includes\footer.html');
 ?>
