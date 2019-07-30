<?php
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" type="text/css" href="mystyle.css" />
<title>Fun Little Wii Bowling League ADMIN</title>
<!-- Describe this page for search engines -->
<meta name="description" content="Wii Bowling League at Saralake Estates">
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
<!-- Link to external style sheet -->
<link href="css/bowling.css" rel="stylesheet" type="text/css">
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
      <a class="navbar-brand concepthw" href="/bowling/">Fun Little Wii Bowling League</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav text-lg-center nav-justified w-100">
          <li class="nav-item">
            <a class="nav-link" href="/bowling/">Main</a>
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
        <?php include("./admin/adminnav.inc.php"); ?>
        </div><!-- /sidebar-offcanvas -->
    <div class="col-xs-12 col-sm-9">
      <div class="row">
        <div class="col-xs-6 col-sm-6 current-leaders">
          <?php
            if (!isset($_REQUEST['content']))
            {
                if (!isset($_SESSION['store_admin']))
                    include("./admin/adminlogin.html");
                else
                    include("./admin/adminmain.inc.php");
            }
            else
            {
                $content = $_REQUEST['content'];
                $nextpage = $content . ".inc.php";
                include("./admin/" . $nextpage);
            } ?>
        </div><!--/current-leaders-->
      </div><!--/row -->
</div><!--/outside-->

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
</body>
</html>