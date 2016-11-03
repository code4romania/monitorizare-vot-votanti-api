<?php 
conectare_db();
$sql = "SELECT * from sesizari";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        


    }
} else {
    echo "0 results";
}
deconectare_db();


?>