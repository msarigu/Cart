<?php
$page_title = "Register";
include ('C:\xampp\htdocs\Progetti_PHP\includes\header.html');

if ($_SERVER['REQUEST_METHOD']=='POST')
  {
    require ('C:\xampp\htdocs\connect_db_c.php');
    $errors=array();

    if(empty($_POST['first_name']))
      {$errors[] = 'Enter first_name';}
    else
      {$fn = mysqli_real_escape_string($dbc, trim($_POST['first_name']));}

    if(empty($_POST['last_name']))
      {$errors[] = 'Enter last_name';}
    else
      {$ln = mysqli_real_escape_string($dbc, trim($_POST['last_name']));}

    if(empty($_POST['email']))
      {$errors[] = 'Enter email';}
    else
      {$e = mysqli_real_escape_string($dbc, trim($_POST['email']));}

    if(empty($_POST['pass1']))
      {$_errors[] = 'Enter password';}
    else

      {if($_POST['pass1'] != $_POST['pass2'])
          {$errors[] = 'Passwords do not match';}
       else
          {$p = mysqli_real_escape_string($dbc, trim($_POST['pass1']));
      }
}

if(empty($errors))
  {$q = "SELECT user_id FROM users WHERE email='$e'";
  $r = mysqli_query($dbc , $q);
  if (mysqli_num_rows($r) !=0)
    {$errors[] = 'Email address already registred
    <a href="login.php">Login</a>';}
  }

if(empty($errors))
  {$q="INSERT INTO users (first_name, last_name, email, password, reg_data)
    VALUES('$fn' , '$ln' , '$e' , SHA1('$p'), NOW())";
    $r = mysqli_query($dbc , $q);

    if($r)
      {echo '<h1> Registred ! </h1>
        <p>You are now registrered</p>
        <p><a href="login.php">Login</a></p>';
      }
    mysqli_close($dbc);
    include ('C:\xampp\htdocs\Progetti_PHP\includes\footer.html');
    exit();
  }
  else
    {echo '<h1> Error! </h1>
    <p id="err_msg">  The following error(s) occurred:<br>';
    foreach($errors as $msg)
      { echo " - $msg<br>";}
    echo 'Please try again</p>';
    }
  }
?>

    <html>
  	<head>
  		<title>esercizio sticky form</title>
  	</head>
  	<body>
    <h1> Register</h1>
    <form action="users.php" method="POST">

    <p>First Name:<input type="text" name="first_name"
        value="<?php if(isset($_POST['first_name']))
        echo $_POST['first_name'];?>">
    </p>
    <p>Last Name:<input type="text" name="last_name"
        value="<?php if(isset($_POST['last_name']))
        echo $_POST['last_name'];?>">

      </p>
      <p>Email Address:<input type="text" name="email"
          value="<?php if(isset($_POST['email']))
          echo $_POST['email'];?>">

      </p>
      <p>Password:<input type="text" name="pass1"
          value="<?php if(isset($_POST['pass1']))
          echo $_POST['pass1'];?>">

      </p>
      <p>Confirm Password:<input type="text" name="pass2"
          value="<?php if(isset($_POST['pass2']))
          echo $_POST['pass2'];?>">

      </p>
      <p><input type = "submit" value= "Register"></p>
  </form>

<?php
include ('C:\xampp\htdocs\Progetti_PHP\includes\footer.html');

 ?>
