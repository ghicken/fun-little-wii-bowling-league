<?php
   $weekno=$_POST['wk'];
   $yearno=$_POST['year_no'];
   $bowlerno=$_POST['absbwlr'];
   $subbowlerno=$_POST['subbwlr'];

   $year = date("Y");

   $query = "SELECT week FROM week WHERE yr_wk_no='$weekno'";
   $result = mysqli_query($conn,$query) or die('Unable to get week');
   $row=mysqli_fetch_array($result,MYSQLI_ASSOC);
   $week = $row['week'];
   
   $query = "SELECT firstname, lastname FROM bowler WHERE bwlr_no='$bowlerno'";
   $result = mysqli_query($conn,$query) or die('Unable to get bowler');
   $row=mysqli_fetch_array($result,MYSQLI_ASSOC);
   $fname = $row['firstname'];
   $lname = $row['lastname'];

   $query = "SELECT firstname, lastname FROM bowler WHERE bwlr_no='$subbowlerno'";
   $result = mysqli_query($conn,$query) or die('Unable to get bowler');
   $row=mysqli_fetch_array($result,MYSQLI_ASSOC);
   $sfname = $row['firstname'];
   $slname = $row['lastname'];
   
   $query = "INSERT INTO sub_week (yr_wk_no, absent_bwlr_no, sub_bwlr_no) VALUES ('$weekno', '$bowlerno', '$subbowlerno')";
   $result = mysqli_query($conn,$query) or die('Unable to add sub_week');
   if ($result)
      echo "<h4>$sfname $slname substituted for $fname $lname on week $week in $year</h4>\n";
   else
      echo "<h4>Problem adding substitute for $fname $lname on week $week in $year</h4>\n";
?>