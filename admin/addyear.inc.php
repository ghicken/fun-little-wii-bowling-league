<?php
   $year=$_POST['year'];
   $query = "INSERT INTO year (year) VALUES ('$year')";

   $result = mysqli_query($conn,$query) or die('Unable to add year');
   if ($result)
      echo "<h4>New year $year added</h4>\n";
   else
      echo "<h4>Problem adding new year $year</h4>\n";
?>