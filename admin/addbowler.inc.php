<?php
   $yearno=$_POST['yr'];
   $teamno=$_POST['tm'];
   $lastname=$_POST['lname'];
   $firstname=$_POST['fname'];
   $query = "SELECT year FROM year WHERE year_no='$yearno'";
   $result = mysqli_query($conn,$query) or die('Unable to get year');
   $row=mysqli_fetch_array($result,MYSQLI_ASSOC);
   $year = $row['year'];
   
   $query = "SELECT name FROM team WHERE tm_no='$teamno'";
   $result = mysqli_query($conn,$query) or die('Unable to get team');
   $row=mysqli_fetch_array($result,MYSQLI_ASSOC);
   $team = $row['name'];
   
   $query = "INSERT INTO bowler (lastname, firstname, year_no, tm_no) VALUES ('$lastname', '$firstname', '$yearno', '$teamno')";
   $result = mysqli_query($conn,$query) or die('Unable to add bowler');
   if ($result)
      echo "<h4>New bowler $firstname $lastname added on $team for $year.</h4>\n";
   else
      echo "<h4>Problem adding new bowler $firstname $lastname on $team for $year.</h4>\n";
?>