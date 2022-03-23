<?php
    include "dbInfo.php";

    global $localHost, $username, $password, $table;

    $myUsername = $_POST['username'];
    $myPassword = $_POST['password'];

    global $host_name, $database, $user_name, $password;

    
    try{
        $conn = mysqli_connect($localHost, $username, $password, $table);

        $sql = "SELECT id FROM users WHERE username = '$myUsername' and passcode = '$myPassword'";
        $result = mysqli_query($conn, $sql);
    
        $count = mysqli_num_rows($result);
    
        if($count == 1){
            echo "Success";
        }else{
            echo "Invalid user";
        }
    }
    catch (exception $e){
        echo json_encode("Failed");
    }

?>