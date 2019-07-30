<?php
if (!isset($_SESSION['store_admin']))
{
   echo "<h4>Sorry, you have not logged into the system</h4>\n";
   echo "<a href=\"admin.php\">Please login</a>\n";
} else
{
   $date = date("Y");
   echo "<form enctype=\"multipart/form-data\" action=\"admin.php\" method=\"post\">\n";
   echo "<h2>Generate Team Orders for Each Week:</h2>\n";
   echo "<h4>Select Year:</h4>\n";
   echo "<p><select name=\"yr\">\n";
   $query="SELECT year_no, year FROM year";
   $result=mysqli_query($conn, $query);
   while($row=mysqli_fetch_array($result)) {
       $year = $row['year'];
       $yn = $row['year_no'];
       echo "<option value=\"$yn\">$year<br>\n";
   }
   echo "</select></p>\n";
   echo "<hr>\n";
   
   $query = "SELECT COUNT(*) AS count FROM team WHERE year_no='3' AND name<>'Substitutes'";
   $result=mysqli_query($conn, $query);
   $row=mysqli_fetch_array($result);
   $tcnt = $row['count'];
   
   echo "<h4>Select Order for Each Team:</h4>\n";
   $place = 0;
   $query="SELECT tm_no, name FROM team WHERE year_no='3' AND name<>'Substitutes'";
   $result=mysqli_query($conn, $query);
   while($row=mysqli_fetch_array($result))
   {
       $tmno = $row['tm_no'];
       $team = $row['name'];
       echo "<h4>$team Order for Week One:</h4>\n";
       echo "<p><select name=\"order$place\">\n";
       for($to = 1; $to <= $tcnt; $to++) {
           echo "<option value=\"$to\">$to<br>\n";
       }
       echo "</select></p>\n";
       $place++;
   }

   echo "<hr>\n";
   echo "<input type=\"hidden\" name=\"tmcnt\" value=\"$tcnt\">\n";
   echo "<input type=\"submit\" value=\"Submit\">\n";
   echo "<input type=\"hidden\" name=\"content\" value=\"genprocess\">\n";
   echo "</form>\n";
}
?>