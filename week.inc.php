<?php
    $weekno=$_GET['wk'];
    // $date = date("Y");
    $date = "2019";
    echo "<h2>Wii Bowling for $date</h2>\n";
    echo "<hr>\n";
    echo "<h4>Week $weekno Scores</h4>\n";
    
    $query = "SELECT year_no FROM year WHERE year='$date'";
    $result=mysqli_query($conn, $query);
    $row=mysqli_fetch_array($result);
    $yearno = $row['year_no'];
    
    $query = "SELECT COUNT(*) AS count FROM team WHERE year_no='3' AND name<>'Substitutes'";
    $result=mysqli_query($conn, $query);
    $row=mysqli_fetch_array($result);
    $team_count = $row['count'];
    
    $query = "SELECT MAX(yr_wk_no) AS max_yr_wk_no, MIN(yr_wk_no) AS min_yr_wk_no FROM week WHERE year_no='$yearno'";
    $result=mysqli_query($conn, $query);
    $row=mysqli_fetch_array($result);
    $maxyrwkno = $row['max_yr_wk_no'];
    $minyrwkno = $row['min_yr_wk_no'];
    
    $query = "SELECT yr_wk_no FROM week WHERE week='$weekno' AND year_no='$yearno'";
    $result=mysqli_query($conn, $query);
    $row=mysqli_fetch_array($result);
    $yrwkno = $row['yr_wk_no'];
    
    $nywn = $yrwkno + 1;

    $query = "SELECT tm_no, bowl_order FROM tm_week WHERE yr_wk_no='$yrwkno'";
    $result=mysqli_query($conn, $query);
    while($row=mysqli_fetch_array($result)) {
        $bt[$row['bowl_order']] = $row['tm_no'];
    }

    $query = "SELECT tm_no, bowl_order FROM tm_week WHERE yr_wk_no='$nywn'";
    $result=mysqli_query($conn, $query);
    while($row=mysqli_fetch_array($result)) {
        $nbt[$row['bowl_order']] = $row['tm_no'];
    }
    
    $lastyrwkno = $minyrwkno - 1;
    
    echo "<div class=block>\n";
    for($tl = 1; $tl <= $team_count; $tl++) {
        $query1 = "SELECT tm_no, name FROM team WHERE year_no='3' AND tm_no='$bt[$tl]'";
        $result1=mysqli_query($conn, $query1);
        $row1=mysqli_fetch_array($result1);
        $teamno = $row1['tm_no'];
        $team = $row1['name'];
        $teamname[$teamno] = $team;
        $xhcp[$teamno] = 0;
        if($team != 'Substitutes') {
        $teamrawscore = 0;
        $teamhandicap = 0;
        $newteamhandicap = 0;
        $teamscore = 0;
        $subrawscore = 0;
        $subhandicap = 0;
        $subscore = 0;
        echo "<p><table width=100% border=1>\n";
        echo "<tr><td colspan=\"4\"><b>$team</b></td></tr>\n";
        $query2 = "SELECT absent_bwlr_no, sub_bwlr_no FROM sub_week WHERE yr_wk_no='$yrwkno'";
        $result2 = mysqli_query($conn, $query2);
        if(mysqli_num_rows($result2) > 0) {
            while($row2=mysqli_fetch_array($result2)) {
                $cnt = 0;
                $absbwlrno = $row2['absent_bwlr_no'];
                $subbwlrno = $row2['sub_bwlr_no'];
                $query3 = "SELECT COUNT(*) AS count FROM bowler WHERE tm_no='$teamno' AND bwlr_no='$absbwlrno'";
                $result3 = mysqli_query($conn, $query3);
                $row21 = mysqli_fetch_array($result3);
                $cnt = $row21['count'];
                if($cnt > 0) {
                    $query4 = "SELECT firstname, lastname FROM bowler WHERE bwlr_no='$subbwlrno'";
                    $result4 = mysqli_query($conn, $query4);
                    $row3=mysqli_fetch_array($result4);
                    $sfname = $row3['firstname'];
                    $slname = $row3['lastname'];
                    $query4a = "SELECT firstname, lastname FROM bowler WHERE bwlr_no='$absbwlrno'";
                    $result4a = mysqli_query($conn, $query4a);
                    $row3a=mysqli_fetch_array($result4a);
                    $afname = $row3a['firstname'];
                    $alname = $row3a['lastname'];
                    echo "<tr><td colspan=4>$sfname $slname[0]. Substituted for $afname $alname[0].</tr>\n";
                }
            }
        }
        echo "<tr><td>Name</td><td>Handicap</td><td>Average</td><td>Score</td></tr>\n";
        $query6 = "SELECT bwlr_no, firstname, lastname FROM bowler WHERE tm_no='$teamno' AND year_no='$yearno'";
        $result6=mysqli_query($conn, $query6);
        while($row5=mysqli_fetch_array($result6)) {
            $raw = 0;
            $bwlrno = $row5['bwlr_no'];
            $fname1 = $row5['firstname'];
            $lname1 = $row5['lastname'];
            $query7 = "SELECT raw_score, avg, score FROM bwlr_week WHERE bwlr_no='$bwlrno' AND yr_wk_no = '$yrwkno'";
            $result7=mysqli_query($conn, $query7);
            $row6=mysqli_fetch_array($result7);
            $lywn = $yrwkno - 1;
            $query7a = "SELECT hndcp FROM bwlr_week WHERE bwlr_no='$bwlrno' AND yr_wk_no = '$lywn'";
            $query7b = "SELECT hndcp FROM bwlr_week WHERE bwlr_no='$bwlrno' AND yr_wk_no = '$yrwkno'";
            $result7a=mysqli_query($conn, $query7a);
            $row6a=mysqli_fetch_array($result7a);
            $result7b=mysqli_query($conn, $query7b);
            $row6b=mysqli_fetch_array($result7b);
            $raw = $row6['raw_score'];
            $avg = $row6['avg'];
            $teamrawscore += $raw;
            if($weekno < 4)
                $hcp = 0;
            else
                $hcp = $row6a['hndcp'];
            $nhcp = $row6b['hndcp'];
            $teamhandicap += $hcp;
            $newteamhandicap += $nhcp;
            $sco = $row6['score'];
            $teamscore += $sco;
            if($raw != 0)
                echo "<tr><td>$fname1 $lname1[0].</td><td>$hcp</td><td>$avg</td><td>$raw</td></tr>\n";
        }
        $xhcp[$teamno] = $newteamhandicap;
        echo "<tr><td>Totals:</td><td>$teamhandicap</td><td>&nbsp;</td><td>$teamrawscore</td></tr>\n";
        if($weekno < 4) {
            echo "<tr><td colspan=\"3\"><b>Final Score:</b></td><td>$teamrawscore</td></tr>\n";
        } else {
            echo "<tr><td colspan=\"3\"><b>Final Score:</b></td><td>$teamscore</td></tr>\n";
        }
        }
        echo "</table></p>\n";
    }
    echo "</div>\n";
    echo "</div><!--/current-leaders-->\n";
    echo "<div class=\"col-xs-6 col-lg-6 standings\">\n
        <h2>Week $weekno Information:</h2>\n
        <hr>\n";

    echo "<h4>Current Team Scores:</h4>\n";

  $fl = 0;
  $c = 0;
  for ($x = $minyrwkno; $x <= $maxyrwkno; $x++) {
    $query1 = "SELECT tm_no, name FROM team WHERE year_no='3'";
    $result1=mysqli_query($conn, $query1);
    while($row1=mysqli_fetch_array($result1))
    {
        $teamno = $row1['tm_no'];
        $team = $row1['name'];
        if($team != 'Substitutes') {
        if($fl == 0) {
            $t1[$c] = $team;
            $c++;
        }
        $flag = 0;
        $teamrawscore1[$team] = 0;
        $teamhandicap1[$team] = 0;
        $teamscore1[$team] = 0;
        $query6 = "SELECT bwlr_no, firstname, lastname FROM bowler WHERE tm_no='$teamno' AND year_no='$yearno'";
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
                if($weekno < 4) {
                    $teamrawscore1[$team] += $raw;
                    $teamhandicap1[$team] += 0;
                    $teamscore1[$team] += $raw;
                } else {
                    $teamrawscore1[$team] += $raw;
                    $hcp = $row6['hndcp'];
                    $teamhandicap1[$team] += $hcp;
                    $sco = $row6['score'];
                    $teamscore1[$team] += $sco;
                }
                $flag = 1;
            }
        }
        $teamtotrawscore[$team] += $teamrawscore1[$team];
        $teamtothandicap1[$team] += $teamhandicap1[$team];
        $teamtotscore[$team] += $teamscore1[$team];
    }
    }
    $fl++;
  }
  
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
  
    echo "<hr>\n
        <h4>Week $weekno Highest Scorers:</h4><p>\n";
    echo "<p>\n";
    $query = "SELECT bwlr_no, raw_score FROM (SELECT yr_wk_no, bwlr_no, raw_score FROM bwlr_week WHERE yr_wk_no='$yrwkno' ORDER BY raw_score DESC, bwlr_no ASC LIMIT 0,3) AS top_three ORDER BY raw_score DESC";
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
    echo "<h4>Average Leaders as of Week $weekno</h4>\n";
    echo "<p>\n";
    $query = "SELECT bwlr_no, avg FROM (SELECT yr_wk_no, bwlr_no, avg FROM bwlr_week WHERE yr_wk_no='$yrwkno' ORDER BY avg DESC, bwlr_no ASC LIMIT 0,3) AS top_three ORDER BY avg DESC";
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
    echo "<hr>\n";
    $nextweekno = $weekno + 1;
    if($nextweekno < 5) {
        echo "<h4>Bowling Order for Week $nextweekno</h4>\n";
        for($tl = 1; $tl <= $team_count; $tl++) {
            $nto = $nbt[$tl];
            $tx = $teamname[$nto];
            echo "<b>$tl. $tx</b><br>\n";
        }
    } else {
        echo "<h4>Bowling Order for Week $nextweekno<br>with Team Handicaps</h4>\n";
        for($tl = 1; $tl <= $team_count; $tl++) {
            $nto = $nbt[$tl];
            $tx = $teamname[$nto];
            echo "<b>$tl. $tx $xhcp[$nto]</b><br>\n";
        }
    }
    echo "</div><!--/standings-->\n";

?>
