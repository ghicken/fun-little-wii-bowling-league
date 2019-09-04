<?php
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" type="text/css" href="mystyle.css" />
<title>Fun Little Wii Bowling League</title>
<!-- Describe this page for search engines -->
<meta name="description" content="Fun Little Wii Bowling League">
<!-- Character set for English and similar languages -->
<meta charset="utf-8">
<!-- Helps with rendering on mobile devices -->
<!-- <meta name="viewport" content="width=device-width"> -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- Mobile Friendly -->
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
<!-- Bootstrap core CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css?family=Satisfy|Open+Sans" rel="stylesheet">
<!-- Link to external style sheets -->
<link href="css/bowling.css" rel="stylesheet" type="text/css">
<link href="css/print.css" rel="stylesheet" media="print">
</head>
<?php
    $servername = "servername";
    $database = "database";
    $username = "username";
    $password = "password";
    
    // Create connection

    $conn = mysqli_connect($servername, $username, $password, $database);

    // Check connection

    if (!$conn) {

        die("Connection failed: " . mysqli_connect_error());

    }
?>
<body>
<script>
// JavaScript code to disable right-click
document.oncontextmenu = function prevent() {
  alert("This material \u00A9 Gary Hicken");
  return false;
};
//Make older browsers aware of new HTML5 layout tags
 'header nav aside article footer section figure figcaption'.replace(/\w+/g, function (n) { document.createElement(n); });
 </script>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
      <a class="navbar-brand concepthw" href="/bowling">Fun Little Wii Bowling League</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav text-lg-center nav-justified w-100">
          <li class="nav-item">
            <a class="nav-link" href="/bowling/admin.php">Admin</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">FAQ</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">More</a>
          </li>
        </ul>
      </div>
    </nav>
    <div class="outside">
      <div class="row row-offcanvas row-offcanvas-right">
        <div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar">
            <?php
                $date = date("Y");
                //$date = "2019";
                $query = "SELECT year_no FROM year WHERE year='$date'";
                $result=mysqli_query($conn, $query);
                $row=mysqli_fetch_array($result);
                $yearno = $row['year_no'];
                
                $query = "SELECT MAX(yr_wk_no) AS yr_wk_no FROM week WHERE year_no='$yearno'";
                $result=mysqli_query($conn, $query);
                $row=mysqli_fetch_array($result);
                $lw = $row['yr_wk_no'];
                
                $query = "SELECT week FROM week WHERE yr_wk_no = '$lw'";
                //$query = "SELECT week FROM week WHERE yr_wk_no = '32'";
                $result = mysqli_query($conn, $query);
                $row = mysqli_fetch_array($result);
                $weeks = $row['week'];

                if($weeks < 2)
                    echo "<h2>2019 - So far $weeks Week:</h2>\n";
                else
                    echo "<h2>2019 - So far $weeks Weeks:</h2>\n";
                echo "<hr>\n";

                echo "<p><a href=\"index.php?content=home\">Home</a></p>\n";
                if($weeks >= 1)
                    echo "<p><a href=\"index.php?content=week&wk=1\">Week One</a></p>\n";
                else
                    echo "<p>Week One</p>\n";
                if($weeks >= 2)
                    echo "<p><a href=\"index.php?content=week&wk=2\">Week Two</a></p>\n";
                else
                    echo "<p>Week Two</p>\n";
                if($weeks >= 3)
                    echo "<p><a href=\"index.php?content=week&wk=3\">Week Three</a></p>\n";
                else
                    echo "<p>Week Three</p>\n";
                if($weeks >= 4)
                    echo "<p><a href=\"index.php?content=week&wk=4\">Week Four</a></p>\n";
                else
                    echo "<p>Week Four</p>\n";
                if($weeks >= 5)
                    echo "<p><a href=\"index.php?content=week&wk=5\">Week Five</a></p>\n";
                else
                    echo "<p>Week Five</p>\n";
                if($weeks >= 6)
                    echo "<p><a href=\"index.php?content=week&wk=6\">Week Six</a></p>\n";
                else
                    echo "<p>Week Six</p>\n";
                if($weeks >= 7)
                    echo "<p><a href=\"index.php?content=week&wk=7\">Week Seven</a></p>\n";
                else
                    echo "<p>Week Seven</p>\n";
                if($weeks >= 8)
                    echo "<p><a href=\"index.php?content=week&wk=8\">Week Eight</a></p>\n";
                else
                    echo "<p>Week Eight</p>\n";
                if($weeks >= 9)
                    echo "<p><a href=\"index.php?content=week&wk=9\">Week Nine</a></p>\n";
                else
                    echo "<p>Week Nine</p>\n";
                if($weeks >= 10)
                    echo "<p><a href=\"index.php?content=week&wk=10\">Week Ten</a></p>\n";
                else
                    echo "<p>Week Ten</p>\n";
            ?>
        </div><!-- /sidebar-offcanvas -->
        <div class="col-xs-12 col-sm-9">
        <div class="row">
        <div class="col-xs-6 col-lg-6 current-leaders">
          <?php
            if (!isset($_REQUEST['content']))
            {
                include("./home.inc.php");
            }
            else
            {
                $content = $_REQUEST['content'];
                $nextpage = $content . ".inc.php";
                include("./" . $nextpage);
            } ?>
        </div><!--/current-leaders-->
        </div><!--/row-->
        </div>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
</body>
</html>
