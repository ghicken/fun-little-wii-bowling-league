<?php
if (!isset($_SESSION['store_admin']))
{
   echo "<h4>Sorry, you have not logged into the system</h4>\n";
   echo "<a href=\"admin.php\">Please login</a>\n";
} else
{
   $date = date("Y");
   $query="SELECT year_no FROM year WHERE year='$date'";
   $result=mysqli_query($conn, $query);
   $row=mysqli_fetch_array($result);
   $yn = $row['year_no'];

   echo "<form enctype=\"multipart/form-data\" action=\"admin.php\" method=\"post\">\n";
   echo "<h2>Bowler Score for $date:</h2>\n";
   echo "<h4>Select Week:</h4>\n";
   echo "<p><select name=\"wk\">\n";
   $query="SELECT yr_wk_no, week from week WHERE year_no=$yn";
   $result=mysqli_query($conn, $query);
   while($row=mysqli_fetch_array($result))
   {
       $yrwkno = $row['yr_wk_no'];
       $week = $row['week'];
       echo "<option value=\"$yrwkno\">$week<br>\n";
   }
   echo "</select></p>\n";
   echo "<h4>Select Bowler:</h4>\n";
   echo "<p><select name=\"bwlr\">\n";
   $query="SELECT bwlr_no, firstname, lastname from bowler WHERE year_no=$yn ORDER BY firstname ASC";
   $result=mysqli_query($conn, $query);
   while($row=mysqli_fetch_array($result))
   {
       $bwlrno = $row['bwlr_no'];
       $fname = $row['firstname'];
       $lname = $row['lastname'];
       echo "<option value=\"$bwlrno\">$fname $lname<br>\n";
   }
   echo "</select></p>\n";

   echo "<h4>Enter the bowler's score:</h4>\n";
   echo "<p><input type=\"text\" size=\"3\" name=\"score\"></p>\n";
   echo "<input type=\"hidden\" name=\"year_no\" value=\"$yn\">\n";
   echo "<input type=\"submit\" value=\"Submit\">\n";
   echo "<input type=\"hidden\" name=\"content\" value=\"addweek\">\n";
   echo "</form>\n";
}
?>