<?php
    include 'dbInfo.php';
    $id = '';
    $isFull = '';

    if (isset($_GET["id"])) {
        $id = $_GET["id"];
    }
    if (isset($_GET["full"])) {
        $isFull = $_GET["full"];
    }

    echo "Today is " . date("Y") . "<br>";
    $day = date("d");
    $month = date("m");
    $year = date("Y");

    function isEmpty($string){
        $s = trim($string);
        if(isset($s) == true && $s == '')
        {
        return true;
        }
        else{
            return false;
        }
    }   

    function printVars(){
        global $id, $long, $lat, $isFull;

        if (isEmpty($id)) {
            echo "<a> id not set </a><br>";
        }else{
            echo "<a>" . $id . "</a><br>";
        }

        if (isEmpty($isFull)) {
            echo "<a> isFull not set </a><br>";
        }else{
            echo "<a>" . $isFull . "</a><br>";
        }
    }

    function InsertValues(){
        global $id, $isFull, $day, $month, $year;
        global $host_name, $database, $user_name, $password;

        if (isEmpty($id) == true && isEmpty($day) == true && isEmpty($month) == true && isEmpty($year) && isEmpty($isFull) == true) {
            echo "Data not provided";
        }
        else{
            
            $conn = mysqli_connect($host_name, $user_name, $password, $database);

            if (!$conn->connect_error) {
                $sql = "INSERT INTO waste_data (BinID, isFull, w_day, w_month, w_year) VALUES (?, ?, ?, ?, ?)";

                // Perpare SQL query
                $statement = $conn->prepare($sql);
                
                // Bind parameters to SQL query and execute
                $statement->bind_param('sssss', $id, $isFull, $day, $month, $year);
                $result = $statement->execute();

                if ($result == TRUE) {
                    echo "<a> Data added! </a><br>";
                }
                else{
                    echo "<a> Error! </a><br>";
                }
                $statement->close();
                $conn->close();
            }
            else{
                echo "<a> Can not connect to database </a><br>";
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Page</title>
</head>
<body>
    <?php printVars() ?>
    <?php InsertValues() ?>
</body>
</html>