<?php
   $date = date("Y");
   echo "<h2>Wii Bowling $date</h2>\n";
   echo "<h2>Fun</h2>\n";
   echo "<hr>\n";
   echo "<h4>Message:</h4>\n";
   if (is_readable("mylibrary/dailymessages.txt"))
   {
      $message = file_get_contents("mylibrary/dailymessages.txt");
      $message = nl2br($message);
      echo $message;
   }
   else
   {
      echo "No messages for today.\n";
   }
   
   echo "<hr>\n";
   $query = "SELECT year_no FROM year WHERE year='$date'";
   $result=mysqli_query($conn, $query);
   $row=mysqli_fetch_array($result);
   $yearno = $row['year_no'];

    $query1 = "SELECT MAX(yr_wk_no) AS max_yr_wk_no, MIN(yr_wk_no) AS min_yr_wk_no FROM week WHERE year_no='$yearno'";
    $result1=mysqli_query($conn, $query1);
    $row1=mysqli_fetch_array($result1);
    $maxyrwkno = $row1['max_yr_wk_no'];
    $minyrwkno = $row1['min_yr_wk_no'];

   $query = "SELECT MIN(tm_no) AS min_tm_no FROM team WHERE year_no='3'";
   $result=mysqli_query($conn, $query);
   $row=mysqli_fetch_array($result);
   $minteamno = $row['min_tm_no'];

   $query = "SELECT COUNT(*) AS count FROM week WHERE year_no='$yearno'";
   $result=mysqli_query($conn, $query);
   $row=mysqli_fetch_array($result);
   $wcnt = $row['count'];
   
   $query = "SELECT yr_wk_no FROM week WHERE year_no='$yearno' AND week='$weeks'";
   $result=mysqli_query($conn, $query);
   $row=mysqli_fetch_array($result);
   $ywn = $row['yr_wk_no'];

   $query = "SELECT COUNT(*) AS count FROM team WHERE year_no='3' AND name<>'Substitutes'";
   $result=mysqli_query($conn, $query);
   $row=mysqli_fetch_array($result);
   $tcnt = $row['count'];

   echo "<h4>Current Teams</h4>\n";
   echo "<p>";
   $queryt="SELECT tm_no, name from team where year_no='3'";
   $resultt=mysqli_query($conn, $queryt);
   while($row=mysqli_fetch_array($resultt))
   {
       $teamno = $row['tm_no'];
       $team = $row['name'];
       $tname[$teamno] = $team;
       echo "<b>$team</b><br>\n";
       $q2="SELECT firstname, lastname FROM bowler WHERE year_no='$yearno' AND tm_no='$teamno'";
       $r2=mysqli_query($conn, $q2);
       while($rw2=mysqli_fetch_array($r2))
       {
           $fname = $rw2['firstname'];
           $lname = $rw2['lastname'];
           echo "&nbsp;&nbsp;&nbsp;$fname $lname[0].<br>\n";
       }
   }
   echo "</p>\n";
  
   echo "<hr>\n
         <h4>Team Schedule</h4>\n";
   $querys = "SELECT yr_wk_no, tm_no, bowl_order FROM tm_week WHERE yr_wk_no>='$minyrwkno' AND yr_wk_no<='$maxyrwkno' ORDER BY yr_wk_no, bowl_order ASC";
   $results=mysqli_query($conn, $querys);
   while($rows=mysqli_fetch_array($results)) {
       $ywno = $rows['yr_wk_no'];
       $tno = $rows['tm_no'];
       $bo = $rows['bowl_order'];
       $week[$ywno][$bo] = $tno;
   }
   
   for($w = 0; $w < $wcnt; $w++) {
       $wk = $w + 1;
       $yrwkno = $minyrwkno + $w;
       echo "<p><table width=100% border=1>\n";
       echo "<tr><td><b>Week $wk</b></td><tr>\n";
       for($t = 1; $t <= $tcnt; $t++) {
           $timp = $week[$yrwkno][$t];
           echo "<tr><td>$t. $tname[$timp]</td><tr>\n";
       }
       echo "</table></p>\n";
   }

   echo "</div><!--/current-leaders-->\n";
   echo "<div class=\"col-xs-6 col-lg-6 standings\">\n
        <h2>Current Standings:</h2>\n
        <hr>\n";
   echo "<h4>Current Team Scores:</h4>\n";

  $fl = 0;
  $c = 0;
  for ($x = $minyrwkno; $x <= $maxyrwkno; $x++) {
    $query1 = "SELECT tm_no, name FROM team WHERE year_no='3'";
    $result1=mysqli_query($conn, $query1);
    while($row1=mysqli_fetch_array($result1))
    {
        $teamn = $row1['tm_no'];
        $team = $row1['name'];
        if($team != 'Substitutes') {
        if($fl == 0) {
            $t1[$c] = $team;
            $c++;
        }
        $flag = 0;
        $teamrawscore[$team] = 0;
        $teamhandicap[$team] = 0;
        $teamscore[$team] = 0;
        $query6 = "SELECT bwlr_no, firstname, lastname FROM bowler WHERE tm_no='$teamn' AND year_no='$yearno'";
        $result6=mysqli_query($conn, $query6);
        while($row5=mysqli_fetch_array($result6)) {
            $raw = 0;
            $bwlrno = $row5['bwlr_no'];
            $fname1 = $row5['firstname'];
            $lname1 = $row5['lastname'];
            $query7 = "SELECT raw_score, hndcp, score FROM bwlr_week WHERE bwlr_no='$bwlrno' AND yr_wk_no = '$x'";
            $result7=mysqli_query($conn, $query7);
            $row6=mysqli_fetch_array($result7);
            $raw = $row6['raw_score'];
            if($raw != 0) {
                $teamrawscore[$team] += $raw;
                $hcp = $row6['hndcp'];
                $teamhandicap[$team] += $hcp;
                $sco = $row6['score'];
                $teamscore[$team] += $sco;
                $flag = 1;
            }
        }
        $teamtotrawscore[$team] += $teamrawscore[$team];
        $teamtothandicap[$team] += $teamhandicap[$team];
        $teamtotscore[$team] += $teamscore[$team];
    }
    }
    $fl++;
  }
  
  echo "<p>\n";
  for($tm = 0; $tm < $c; $tm++) {
    $team = $t1[$tm];
    $tarray[$tm] = array("teamx" => "$team", "scorex" => "$teamtotscore[$team]");
    //echo "<b>$team: </b>$teamtotscore[$team]<br>\n";
  }
  
  function build_sorter($key) {
    return function ($a, $b) use ($key) {
        return strnatcmp($a[$key], $b[$key]);
    };
  }

  usort($tarray, build_sorter('scorex'));

  foreach (array_reverse($tarray, true) as $item) {
    //echo $item['key_a'] . ', ' . $item['key_b'] . "\n";
    echo "<b>" . $item['teamx'] . ":</b> " . $item['scorex'] . "<br>\n";
  }
  
  echo "</p>\n";
  echo "<hr>\n";
    echo "<h4>Week $weeks Highest Scorers:</h4><p>\n";
    echo "<p>\n";
    $query = "SELECT bwlr_no, raw_score FROM (SELECT yr_wk_no, bwlr_no, raw_score FROM bwlr_week WHERE yr_wk_no='$ywn' ORDER BY raw_score DESC, bwlr_no ASC LIMIT 0,3) AS top_three ORDER BY raw_score DESC";
    $result=mysqli_query($conn, $query);
    while($row=mysqli_fetch_array($result)) {
        $bwlrno = $row['bwlr_no'];
        $sc = $row['raw_score'];
        $q1 = "SELECT firstname, lastname FROM bowler WHERE bwlr_no='$bwlrno'";
        $r1=mysqli_query($conn, $q1);
        $rw1 = mysqli_fetch_array($r1);
        $fn1 = $rw1['firstname'];
        $ln1 = $rw1['lastname'];
        echo "<b>$fn1 $ln1[0].:</b> $sc<br>\n";
    }
    echo "</p>\n";
    echo "<hr>\n";
  echo "<h4>Highest Averages as of Week $weeks</h4>\n";
    echo "<p>\n";
    $query = "SELECT bwlr_no, avg FROM (SELECT yr_wk_no, bwlr_no, avg FROM bwlr_week WHERE yr_wk_no='$ywn' ORDER BY avg DESC, bwlr_no ASC LIMIT 0,3) AS top_three ORDER BY avg DESC";
    $result=mysqli_query($conn, $query);
    while($row=mysqli_fetch_array($result)) {
        $bwlrno2 = $row['bwlr_no'];
        $a = $row['avg'];
        $q2 = "SELECT firstname, lastname FROM bowler WHERE bwlr_no='$bwlrno2'";
        $r2=mysqli_query($conn, $q2);
        $rw2 = mysqli_fetch_array($r2);
        $fn2 = $rw2['firstname'];
        $ln2 = $rw2['lastname'];
        echo "<b>$fn2 $ln2[0].:</b> $a<br>\n";
    }
    echo "</p>\n";
   echo "</div><!--/standings-->\n";
