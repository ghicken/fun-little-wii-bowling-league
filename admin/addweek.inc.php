<?php
   $weekno=$_POST['wk'];
   $yearno=$_POST['year_no'];
   $bowlerno=$_POST['bwlr'];
   $raw=$_POST['score'];
   
   $year = date("Y");

   $query = "SELECT MIN(yr_wk_no) AS min_yr_wk_no FROM week WHERE year_no='$yearno'";
   $result = mysqli_query($conn,$query) or die('Unable to get week');
   $row=mysqli_fetch_array($result,MYSQLI_ASSOC);
   $minyrwkno = $row['min_yr_wk_no'];

   $query = "SELECT week FROM week WHERE yr_wk_no='$weekno'";
   $result = mysqli_query($conn,$query) or die('Unable to get week');
   $row=mysqli_fetch_array($result,MYSQLI_ASSOC);
   $week = $row['week'];
   
   $query = "SELECT firstname, lastname FROM bowler WHERE bwlr_no='$bowlerno'";
   $result = mysqli_query($conn,$query) or die('Unable to get bowler');
   $row=mysqli_fetch_array($result,MYSQLI_ASSOC);
   $fname = $row['firstname'];
   $lname = $row['lastname'];
   
   if($week == 1) {
       $avg = $raw;
       if($raw < 200)
       {
           $h = (200 - $raw) * .8;
           $fh = floatval ( $h );
           $ih = intval ( $h );
           if($fh - $ih < .5)
              $handicap = $ih;
           else
              $handicap = $ih + 1;
       }
       else
       {
           $h = (200 - $raw) * .8;
           $fh = floatval ( $h );
           $ih = intval ( $h );
           if($fh + $ih > .6)
              $handicap = $ih;
           else
              $handicap = $ih - 1;
       }
       $score = $raw + $handicap;
   }
   else
   {
       $totrawscore = 0;
       for($z = $minyrwkno; $z < $weekno; $z++) {
           $query = "SELECT raw_score FROM bwlr_week WHERE bwlr_no='$bowlerno' AND yr_wk_no='$z'";
           $result = mysqli_query($conn,$query);
           $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
           $rs = $row['raw_score'];
           $totrawscore += $rs;
       }
       $lwk = $weekno - 1;
       $query = "SELECT hndcp FROM bwlr_week WHERE bwlr_no='$bowlerno' AND yr_wk_no='$lwk'";
       $result = mysqli_query($conn,$query);
       $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
       $lhndcp = $row['hndcp'];
       $totrawscore += $raw;
       $favg = floatval($totrawscore / $week);
       $iavg = intval($favg);
       if($favg - $iavg >= .5 )
           $avg = $iavg + 1;
       else
           $avg = $iavg;
       if($avg < 200)
       {
           $h = (200 - $avg) * .8;
           $fh = floatval ( $h );
           $ih = intval ( $h );
           if($fh - $ih < .5)
              $handicap = $ih;
           else
              $handicap = $ih + 1;
       }
       else
       {
           $h = (200 - $avg) * .8;
           $fh = floatval ( $h );
           $ih = intval ( $h );
           if($fh + $ih > .6)
              $handicap = $ih;
           else
              $handicap = $ih - 1;
       }
       $score = $raw + $lhndcp;
   }
   
   echo "</div><!--/current-leaders-->\n";
   echo "<div class=\"col-xs-6 col-lg-6 standings\">\n
        <h2>Current Standings:</h2>\n
        <hr>\n";
   
   if($week == 1) {
       echo "<p>$fname $lname[0]. had a score of $raw. This averages out to $avg after 1 week. Handicap of $handicap.</p>\n";
   } else {
       echo "<p>$fname $lname[0]. had a score of $raw. This averages out to $avg after $week weeks. handicap of $handicap.</p>\n";
   }

   if($week < 4) {
       $query = "INSERT INTO bwlr_week (yr_wk_no, bwlr_no, raw_score, avg, hndcp, score) VALUES ('$weekno', '$bowlerno', '$raw', '$avg', 0, '$raw')";
   } else {
       $query = "INSERT INTO bwlr_week (yr_wk_no, bwlr_no, raw_score, avg, hndcp, score) VALUES ('$weekno', '$bowlerno', '$raw', '$avg', '$handicap', '$score')";
   }
   $result = mysqli_query($conn,$query) or die('Unable to add bwlr_week');
   if ($result)
      echo "<h4>Added score for $fname $lname on week $week in $year</h4>\n";
   else
      echo "<h4>Problem adding score for $fname $lname on week $week in $year</h4>\n";
   echo "</div><!--/standings-->\n";
?>