<?php
if (!isset($_SESSION['store_admin']))
{
   echo "<h4>Sorry, you have not logged into the system</h4>\n";
   echo "<a href=\"admin.php\">Please login</a>\n";
} else
{
   echo "<h4>Years posted already:</h4>\n";
   echo "<p>";
   $query="SELECT year from year";
   $result=mysqli_query($conn, $query);
   while($row=mysqli_fetch_array($result))
   {
       $year = $row['year'];
       echo "$year<br>\n";
   }
   echo "</p>\n";

   $userid = $_SESSION['store_admin'];
   echo "<form enctype=\"multipart/form-data\" action=\"admin.php\" method=\"post\">\n";
   echo "<h4>Enter the new year:</h4>\n";
   echo "<p>Year</td><td><input type=\"text\" size=\"4\" name=\"year\"></p>\n";
   echo "<input type=\"submit\" value=\"Submit\">\n";
   echo "<input type=\"hidden\" name=\"content\" value=\"addyear\">\n";
   echo "</form>\n";
}
?>