<?php 
    include 'dbInfo.php';

class RestService
{
    private $supportedMethods;
    private $games;
    
    public function __construct() 
    {
		$this->supportedMethods = "GET, PUT, POST, DELETE";
    }
    function HandleRequest()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $requestBody = file_get_contents('php://input');

        if (isset($_SERVER['REQUEST_METHOD']))
        {
            switch($_SERVER['REQUEST_METHOD'])
            {
                case 'PUT':
                    //echo "PUT";
                    //$this->EditVideoGame($requestBody);
                    break;

                case 'DELETE':
                    //echo "DELETE";
                    //$this->DeleteVideoGame($requestBody);
                    break;

                case 'GET':
                    //echo "GET";
                    $this->GetAllBins();
                    //echo json_encode($this->games);
                    break;

                case 'POST':
                    //echo "POST";
                    //$this->AddVideoGame($requestBody);
                    
                    break;
            }
        }
        else{
            echo "Request method not set";
        }

        //echo $method;
    }

    function GetAllBins()
    {
        global $localHost, $username, $password, $table;

        $conn = mysqli_connect($localHost, $username, $password, $table);

        //get data from bin_data table
        $result = mysqli_query($conn, 'SELECT * FROM bin_data');
        
        //storing result in array
        $data = array();
        while ($row = mysqli_fetch_assoc($result))
        {
            array_push($data, $row);
        }
        
        //return response in JSON
        echo json_encode($data);
        exit();
    }

    function AddBin($requestBody)
    {
        $data = json_decode($requestBody, true);

        
    }
}
    
?>