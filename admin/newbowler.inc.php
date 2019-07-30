<?php
if (!isset($_SESSION['store_admin']))
{
   echo "<h4>Sorry, you have not logged into the system</h4>\n";
   echo "<a href=\"admin.php\">Please login</a>\n";
} else
{
   echo "<form enctype=\"multipart/form-data\" action=\"admin.php\" method=\"post\">\n";
   echo "<h4>Select Year:</h4>\n";
   echo "<p><select name=\"yr\">\n";
   $query="SELECT year_no, year from year";
   $result=mysqli_query($conn, $query);
   while($row=mysqli_fetch_array($result))
   {
       $yearno = $row['year_no'];
       $year = $row['year'];
       echo "<option value=\"$yearno\">$year<br>\n";
   }
   echo "</select></p>\n";
   echo "<h4>Select Team:</h4>\n";
   echo "<p><select name=\"tm\">\n";
   $query="SELECT tm_no, name from team";
   $result=mysqli_query($conn, $query);
   while($row=mysqli_fetch_array($result))
   {
       $teamno = $row['tm_no'];
       $team = $row['name'];
       echo "<option value=\"$teamno\">$team<br>\n";
   }
   echo "</select></p>\n";

   echo "<h4>Enter the new bowler:</h4>\n";
   echo "<p>First name: <input type=\"text\" size=\"25\" name=\"fname\"></p>\n";
   echo "<p>Last name: <input type=\"text\" size=\"25\" name=\"lname\"></p>\n";
   echo "<input type=\"submit\" value=\"Submit\">\n";
   echo "<input type=\"hidden\" name=\"content\" value=\"addbowler\">\n";
   echo "</form>\n";
}
?>