<?php
session_start();
if ($_SESSION['login_user']) {
    ?>
<?php include "admin_head.php";?>
<div class="col-md-12">
<div class="row">
<div class="col-md-3">
  <a href = "admin.php?stare=0">Sesizari nemoderate</a>
</div>
<div class="col-md-3">
  <a href = "admin.php?stare=1">Sesizari aprobate</a>
</div>
<div class="col-md-3">
  <a href = "admin.php?stare=2">Sesizari respinse</a>
</div>
<div class="col-md-3">
  <a href = "logout.php">Sign Out</a>
</div>
</div>
<div class="row">
<?php
if (isset($_GET['stare'])) {
    $stare=$_GET['stare'];
} else {
    $stare=0;
}
afiseaza_sesizari($stare);?>
</div>
</div>
  
  </body>
  </html>
    <?php
} else {
    header("location: index.php");
}
?>
