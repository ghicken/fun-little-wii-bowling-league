<?php
   $yearno=$_POST['yr'];
   $week=$_POST['wk'];
   
   $query = "SELECT year FROM year WHERE year_no='$yearno'";
   $result = mysqli_query($conn,$query);
   $row=mysqli_fetch_array($result);
   $year = $row['year'];
   
   $query = "INSERT INTO week (year_no, week) VALUES ('$yearno', '$week')";
   $result = mysqli_query($conn,$query) or die('Unable to add week');
   if ($result)
      echo "<h4>New week year $year week $week added</h4>\n";
   else
      echo "<h4>Problem adding new week $year week $week</h4>\n";
?>