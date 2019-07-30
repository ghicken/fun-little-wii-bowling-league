<?php
if (!isset($_SESSION['store_admin']))
{
   echo "<h4>Sorry, you have not logged into the system</h4>\n";
   echo "<a href=\"admin.php\">Please login</a>\n";
} else
{
  $userid = $_SESSION['store_admin'];
   echo "<form enctype=\"multipart/form-data\" action=\"admin.php\" method=\"post\">\n";
   echo "<h4>Select Year:</h4>\n";
   echo "<select name=\"yr\">\n";
   $query="SELECT year_no, year from year";
   $result=mysqli_query($conn, $query);
   while($row=mysqli_fetch_array($result))
   {
       $yearno = $row['year_no'];
       $year = $row['year'];
       echo "<option value=\"$yearno\">$year<br>\n";
   }
   echo "</select>\n";
   echo "<h4>Enter the new team:</h4>\n";
   echo "<p><input type=\"text\" size=\"30\" name=\"tm\"></p>\n";
   echo "<input type=\"submit\" value=\"Submit\">\n";
   echo "<input type=\"hidden\" name=\"content\" value=\"addteam\">\n";
   echo "</form>\n";
}
?>