<?php
session_start();
include ("../library/login.php");
login();

$userid = $_POST['userid'];
$password = $_POST['password'];
echo "User ID = $userid and Password = $password.";
$query = "SELECT userid, name from admins where userid='$userid' and password='$password'";
$result = mysqli_query($query);

$numrows = (mysqli_num_rows($result) == 0);
echo "Numrows = $numrows";
if($numrows == 0)
{
   echo "<h2>Sorry, your account was not validated.</h2><br>\n";
   echo "<a href=\"../admin.php\">Try again</a><br>\n";
} else
{
   echo "It worked!";
   $_SESSION['store_admin'] = $userid;
   header("Location: ../admin.php");
}
?>