<?php
    include 'config.php';

    $sql = "SELECT * FROM products ORDER BY pID DESC";
    $result = $conn->query($sql);
    $myarray = array();

    if ($result->num_rows > 0) {
        while($row =mysqli_fetch_assoc($result)){
            $myarray[] = $row;
        }
    echo json_encode($myarray);
    }
    $conn->close();
?>