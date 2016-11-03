<?php function afiseaza_sesizari(){
    include( $_SERVER['DOCUMENT_ROOT'] . '/monitorizare-vot-votanti/db_connect.php' );
    $sql = "SELECT * from sesizari";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) { ?>
    <div class="row">
      <div class="col-md-3">
      <span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span>
    
      </div>
      <div class="col-md-6">
        <?php
            echo $row['nume'].", ".$row['judet'].", ". $row['localitate'].", ". $row['sectia'].", ". $row['tip_problema'].", "."<br />";
            echo "<p>".$row['detalii']."</p>";
            ?>
      </div>
      <div class="col-md-3">
        
      </div>
    </div>
    <?php  }
    } else {
        echo "Nu sunt sesizari";
    }
    $conn->close();
}
?>