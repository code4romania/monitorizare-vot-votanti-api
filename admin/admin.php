<?php
session_start();
if($_SESSION['login_user'])
{ ?>
<?php include "admin_head.php";?>
<div class="col-md-12">
<?php afiseaza_sesizari();?>
</div>
    <a href = "logout.php">Sign Out</a>
  </body>
  </html>
  <?php
} else
{
    header("location: index.php");
}
?>