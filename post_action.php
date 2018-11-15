<?php
session_start();
require('login_tools.php');

if(!isset($_SESSION['user_id']))
  {load();}


$page_title='Post Error';
include ('C:\xampp\htdocs\Progetti_PHP\includes\header.html');

if ($_SERVER['REQUEST_METHOD'] =='POST')
  {
    if (empty($_POST['subject']))
      {echo '<p> Please enter a subject for this post:</p>';}
    if (empty($_POST['messagge']))
      {echo '<p> Please enter a messagge for this post:</p>';}


    if (!empty($_POST['subject']) AND !empty($_POST['messagge']))
      {
        require ('C:\xampp\htdocs\connect_db_forum.php');
        $q="INSERT INTO forum (first_name, last_name, subject, messagge, post_date)
        VALUES(
          '$_SESSION[first_name]' , '$_SESSION[last_name]' , '$_POST[subject]' , '$_POST[messagge]' , NOW())";

        $r=mysqli_query($dbc,$q);
        if (mysqli_affected_rows($dbc) !=1)
          {echo '<p> Error</p>' .mysqli_error($dbc);}
        else
          {load ('post_forum.php');}
    mysqli_close($dbc);
  }
}
  echo'<p><a href="post_forum.php"> Forum</a>';
  include ('C:\xampp\htdocs\Progetti_PHP\includes\footer.html');

?>
