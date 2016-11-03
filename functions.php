<?php
function scrie_sesizare($nume,  $judet,  $localitate,  $sectia,  $tip_problema,  $mesaj){
    if($judet&&$localitate&&$tip_problema&&$mesaj)
    {
        include("db_connect.php");
        $nume = mysqli_real_escape_string($conn, $nume);
        $judet = mysqli_real_escape_string($conn,$judet);
        $localitate = mysqli_real_escape_string($conn, $localitate);
        $sectia = mysqli_real_escape_string($conn, $sectia);
        $mesaj = mysqli_real_escape_string($conn, $mesaj);
        $tip_problema = mysqli_real_escape_string($conn, $tip_problema);
        $sql = "INSERT INTO sesizari (nume, judet, localitate, sectia, tip_problema, detalii)
        VALUES ('$nume', '$judet', '$localitate','$sectia', '$tip_problema', '$mesaj' )";
        if ($conn->query($sql) === TRUE) { ?>
  <div class="succes">
    <h2>Îți mulțumim că ești un cetățean activ!</h2>
  </div>
  <?php
        } else {
            echo  "Error: " . $sql . "<br>" . $conn->error;
        }
        $conn->close();
    }
    else {
        echo "Toate câmpurile marcate cu * trebuie completate";
    }
}
function afiseaza_sesizari_aprobate(){
    include("db_connect.php");
    $sql = "SELECT * from sesizari where status=1";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) { ?>
    <div class="row">
      <div class="col-md-3">
      <span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span>
    
      </div>
      <div class="col-md-9">
        <?php
            echo $row['nume'].", ".$row['judet'].", ". $row['localitate'].", ". $row['sectia'].", ". $row['tip_problema'].", "."<br />";
            echo "<p>".$row['detalii']."</p>";
            ?>
      </div>
    </div>
    <?php  }
    } else {
        echo "Nu sunt sesizari";
    }
    $conn->close();
}
?>