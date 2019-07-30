<?php
   $userid = $_SESSION['store_admin'];
   if(!$conn) {
       echo "<p>Global variable not working.</p>\n";
   }
   $query = "SELECT name from admins WHERE userid = '$userid'";
   $result=mysqli_query($conn,$query) or die ("Something wrong!");
   $row=mysqli_fetch_array($result,MYSQLI_ASSOC);
   $name = $row['name'];

   echo "<p>Welcome, $name</p>\n";

   $date = date("l, F j, Y");
   echo "<p>Today's date: $date</p>\n";
   echo "</div><!--/current-leaders-->\n";
   echo "<div class=\"col-xs-6 col-lg-6 standings\">\n
        <h2>Current Standings:</h2>\n
        <hr>\n";
   echo "</div><!--/standings-->\n";
?>

