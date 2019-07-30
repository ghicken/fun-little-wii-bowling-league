<h3>SEWBL Administration</h3>
<p></p><a href="admin.php"><strong>Home</strong></a></p>
<?php
   if (isset($_SESSION['store_admin']))
   {
      echo "<hr size=\"1\" noshade=\"noshade\" />\n";
      echo "<p><a href=\"admin.php?content=newteam\"><strong>Add a new team</strong></a></p>\n";
      echo "<p><hr size=\"1\" noshade=\"noshade\" /></p>\n";
      echo "<p><a href=\"admin.php?content=newbowler\"><strong>Add a new bowler</strong></a></p>\n";
      echo "<p><hr size=\"1\" noshade=\"noshade\" /></p>\n";
      echo "<p><a href=\"admin.php?content=newweek\"><strong>Add a new week</strong></a></p>\n";
      echo "<p><hr size=\"1\" noshade=\"noshade\" /></p>\n";
      echo "<p><a href=\"admin.php?content=process\"><strong>Process week</strong></a></p>\n";
      echo "<p><hr size=\"1\" noshade=\"noshade\" /></p>\n";
      echo "<p><a href=\"admin.php?content=subprocess\"><strong>Substitute Process week</strong></a></p>\n";
      echo "<p><hr size=\"1\" noshade=\"noshade\" /></p>\n";
      echo "<p><a href=\"admin.php?content=newyear\"><strong>Add a new year</strong></a></p>\n";
      echo "<p><hr size=\"1\" noshade=\"noshade\" /></p>\n";
      echo "<p><a href=\"admin.php?content=genteamorder\"><strong>Generate Team Order</strong></a></p>\n";
      echo "<p><hr size=\"1\" noshade=\"noshade\" /></p>\n";
      echo "<p><a href=\"logout.php\"><strong>Log Out</strong></a></p>\n";
   }
?>