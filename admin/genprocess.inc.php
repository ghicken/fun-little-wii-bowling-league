<?php
   $tcnt=$_POST['tmcnt'];
   $yearno=$_POST['yr'];
   
   for($l = 0; $l < $tcnt; $l++) {
       $order[$l] = $_POST["order$l"];
   }
   
   $query = "SELECT MIN(yr_wk_no) AS min_yr_wk_no FROM week WHERE year_no='$yearno'";
   $result=mysqli_query($conn, $query);
   $row=mysqli_fetch_array($result);
   $minyrwkno = $row['min_yr_wk_no'];
   
   $query = "SELECT MIN(tm_no) AS min_tm_no FROM team WHERE year_no='3'";
   $result=mysqli_query($conn, $query);
   $row=mysqli_fetch_array($result);
   $minteamno = $row['min_tm_no'];
   
   $query = "SELECT COUNT(*) AS count FROM week WHERE year_no='$yearno'";
   $result=mysqli_query($conn, $query);
   $row=mysqli_fetch_array($result);
   $wcnt = $row['count'];
   
   for($w = 0; $w < $wcnt; $w++) {
       $yrwkno = $minyrwkno + $w;
       $wk = $w + 1;
       $tc = $minteamno;
       foreach ($order as $k => $o) {
           $p = $w;
           if($wk > 5) {
               $p = $p - $tcnt;
           }
           $wo = $o - $p;
           if($wo < 1) {
               $wo += $tcnt;
           }
           $query = "INSERT INTO tm_week (yr_wk_no, tm_no, bowl_order) VALUES ('$yrwkno', '$tc', '$wo')";
           $result1=mysqli_query($conn, $query) or die('Unable to add tm_week');
           if($result1) {
               // do nothing
           } else {
               echo "Could not add $yrwkno, $tc, $wo into table<br>\n";
           }
           $tc++;
       }
   }
   

   echo "</div><!--/current-leaders-->\n";
   echo "<div class=\"col-xs-6 col-lg-6 standings\">\n
        <h2>Result:</h2>\n
        <hr>\n";
        
   $query = "SELECT tm_no, name FROM team WHERE year_no='1'";
   $result=mysqli_query($conn, $query);
   while($row=mysqli_fetch_array($result)) {
       $tname[$row['tm_no']] = $row['name'];
   }
   
   $query = "SELECT yr_wk_no, tm_no, bowl_order FROM tm_week ORDER BY yr_wk_no, bowl_order ASC";
   $result=mysqli_query($conn, $query);
   echo "<table width=100% border=1>";
   while($row=mysqli_fetch_array($result)) {
       $ywno = $row['yr_wk_no'];
       $tmno = $row['tm_no'];
       $bo = $row['bowl_order'];
       $week[$yrwkno][$bo] = $tmno;
   }
   
   for($w = 0; $w < $wcnt; $w++) {
       $wk = $w + 1;
       $yrwkno = $minyrwkno + $w;
       echo "<p><table width=100% border=1>\n";
       echo "<tr><td><b>Week $wk</b></td><tr>\n";
       for($t = 1; $t <= $tcnt; $t++) {
           $temp = $week[$yrwkno][$t];
           echo "<tr><td>$tname[$temp]</td><tr>\n";
       }
       echo "</table></p>\n";
   }
   echo "</div><!--/standings-->\n";
?>