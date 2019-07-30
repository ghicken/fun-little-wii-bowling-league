<?php
   echo "</div><!--/current-leaders-->\n";
   echo "<div class=\"col-xs-6 col-lg-6 standings\">\n
        <h2>Current Standings:</h2>\n
        <hr>\n";
   echo "</div><!--/standings-->\n";
   $yearno=$_POST['yr'];
   $team=$_POST['tm'];
   $query = "SELECT year FROM year WHERE year_no='$yearno'";
   $result = mysqli_query($conn,$query) or die('Unable to get year');
   $row=mysqli_fetch_array($result,MYSQLI_ASSOC);
   $year = $row['year'];
   
   $query = "INSERT INTO team (name, year_no) VALUES ('$team', '$yearno')";
   $result = mysqli_query($conn,$query) or die('Unable to add team');
   if ($result)
      echo "<h4>New team $team added for $year.</h4>\n";
   else
      echo "<h4>Problem adding team $team for $year.</h4>\n";
?>