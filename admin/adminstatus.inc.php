<?php
   if (isset($_SESSION['store_admin']))
   {
      echo "<h2>Current admin status:</h2>\n";
      $y = date("Y");
      
      echo "<h4>For Year $y:</h4>\n";
   }
?>