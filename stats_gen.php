<?php
  include("db_connect.php");
    $aprobate_query = "SELECT * from sesizari where status=1";
    $total = mysqli_num_rows($conn->query($aprobate_query));
    $sql = "SELECT judet from sesizari where status=1 group by judet order by count(*) desc limit 1";
    $result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $top_judet=$row['judet'];
    }
} else {
    echo "Nu sunt sesizari";
}
    $insert[]=array('aprobate'=>$total, 'judet'=>$top_judet);
    $fp = fopen('stats.json', 'w');
    fwrite($fp, json_encode($insert));
    fclose($fp);
    $conn->close();
