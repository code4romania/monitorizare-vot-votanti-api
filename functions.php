<?php
global $conn;
function conectare_db(){
    include "db_connect.php";
    $conn = new mysqli($dbserver, $dbusername, $dbpassword, $dbname);
    mysqli_set_charset($conn, "utf8");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
}
function deconectare_db(){
    $conn->close();
}

function scrie_sesizare($nume, $judet, $localitate, $sectia, $tip_problema, $mesaj){
    $sql = "INSERT INTO sesizari (nume, judet, localitate, sectia, tip_problema, detalii)
    VALUES ('$nume', '$judet', '$localitate','$sectia', '$tip_problema', '$mesaj' )";
    if ($conn->query($sql) === TRUE) { ?>
  <div class="succes">
    <h2>Îți mulțumim că ești un cetățean activ!</h2>
  </div>
  <?php
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    
}
?>