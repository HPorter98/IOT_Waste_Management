<?php
    require "dbInfo.php";

    $binID = $_GET['bin_id'];
    global $localHost, $username, $password, $table;

    $conn = mysqli_connect($localHost, $username, $password, $table);

    //get data from bin_data table
    $query = "SELECT b.BinId, b.Latitude, b.Longitude, w.isFull, w.w_day, w.w_month, w.w_year FROM bin_data b INNER JOIN waste_data w ON b.BinId = w.BinId WHERE b.BinId = '$binID'";
    $result = mysqli_query($conn, $query);
    
    //storing result in array
    $data = array();
    while ($row = mysqli_fetch_assoc($result))
    {
        array_push($data, $row);
    }
    
    //return response in JSON
    echo json_encode($data);
    exit();

?>