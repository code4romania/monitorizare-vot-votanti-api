<?php function afiseaza_sesizari($stare){
    include( './../db_connect.php' );
    if(isset($_POST['actiune'])){
            $sesizare_id=$_POST['sesizare_id'];
            $status_nou=$_POST['actiune'];
            $actiune="update sesizari set status='$status_nou' where id='$sesizare_id'";
            $conn->query($actiune);
        }
    $stare = mysqli_escape_string($conn,$stare);
    $sql = "SELECT * from sesizari where status='$stare'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) { ?>
    <div class="row">
    <div class="item_sesizare">
      <div class="col-md-2">
      <span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span>
    
      </div>
      <div class="col-md-6">
        <?php
            echo $row['nume'].", ".$row['judet'].", ". $row['localitate'].", ". $row['sectia'].", ". $row['tip_problema'].", "."<br />";
            echo "<p>".$row['detalii']."</p>";
            ?>
      </div>
      <div class="col-md-4">
      <?php if ($row['status']==2){ ?>
        <form method="post" action="">
        <input type="hidden" name="actiune" value="1">
        <input type="hidden" name="sesizare_id" value="<?php echo $row['id'];?>">
        <input type="submit" value="Aprobă">
        </form>
      <?php } elseif ($row['status']==1){ ?>
        <form method="post" action="">
        <input type="hidden" name="sesizare_id" value="<?php echo $row['id'];?>">
        <input type="hidden" name="actiune" value="2">
        <input type="submit" value="Respinge">
        </form>
      <?php } else {?>
      <div class='col-md-6'>
        <form method="post" action="">
        <input type="hidden" name="sesizare_id" value="<?php echo $row['id'];?>">
        <input type="hidden" name="actiune" value="2">
        <input type="submit" value="Respinge">
        </form>
        </div>
        <div class='col-md-6'>
        <form method="post" action="">
        <input type="hidden" name="actiune" value="1">
        <input type="hidden" name="sesizare_id" value="<?php echo $row['id'];?>">
        <input type="submit" value="Aprobă">
        </form>
        </div>
      <?php } ?>
      
      </div>
    </div>
    </div>
    <?php  }
    } else {
        echo "Nu sunt sesizari";
    }
    $conn->close();
}
?>