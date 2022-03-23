

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="Scripts/jquery-1.10.2.min.js"></script>
    <script src="Scripts/APIHandler.js"></script>
    <link href="https://api.mapbox.com/mapbox-gl-js/v2.7.0/mapbox-gl.css" rel="stylesheet">
    <script src="https://api.mapbox.com/mapbox-gl-js/v2.7.0/mapbox-gl.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.1/dist/chart.min.js"></script>
    <link rel="stylesheet" href="style.css">
    <title>Test Page</title>
</head>
<body>
    <h1>Test Page</h1>
    <div class="container"> 
        <input type="text" id="inputID" placeholder="Enter ID">
        <button id= "btn1" onclick="GetData()">Display Data</button>
        <button id= "btn2" onclick="RemoveMarker()">Remove Marker</button>
        <table id="mainTable">
            <thead id="binTableHead" class="binTableHead"></thead>
            <tbody id="binTable" class="binTable"></tbody>
        </table>
    </div>

    <div id="map"></div>
    <script> InitMap(-1.4763698458105152, 52.92121736875149, 12); </script>

    <div class="divChart" id="divChart">
        <canvas id="chart"></canvas>
    </div>

</body>
</html>