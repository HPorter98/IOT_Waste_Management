var data;

var map;
var marker;
var isDrawn = false;
var myChart;

function GetData(){
    var id = document.getElementById("inputID").value;
    $.ajax({
        url: "API/getBinByID.php",
        type: "GET",
        data: {
            bin_id: id
        },
        success: function (dataResult){
            var dataList = dataResult;
            CreateDataTable(dataList);
            ConfigChart(dataList);
        }
    });
}

function LogIn(){

    var name = document.getElementById("username").value;
    var pass = document.getElementById("password").value;

    $.ajax({
        url: "API/login.php",
        type: "POST",
        data: {
            username: name,
            password: pass,
        },
        success: function (dataResult){
            // console.log(dataResult);
            if(dataResult === "Success"){
                console.log("User found");
                window.location.replace("test.php");
            }else{
                document.getElementById("alertText").style.display = "block";
                console.log("User not found");
            }
        }
    })
}

function CreateDataTable(dataList)
{
    data = JSON.parse(dataList);
    console.log(data);

    var html = "";
    marker = new mapboxgl.Marker();

    var tHead = "<thead><tr><th>Bin ID</th><th>isFull</th><th>Date</th></tr></thead>";
    document.getElementById("binTableHead").innerHTML = tHead;

    for(var i = 0; i <data.length; i++)
    {
        var id = data[i].BinId;
        var isFull = data[i].isFull;
        var wdate = new Date(data[i].w_month + "/" + data[i].w_day + "/" + data[i].w_year).toLocaleDateString('en-us');
        var lat = data[i].Latitude;
        var long = data[i].Longitude;
        
        html += "<tr>";
        html += "<td>" + id + "</td>";
        html += "<td>" + isFull + "</td>";
        html += "<td>" + wdate + "</td>";
        html += "</tr>";
    }
    document.getElementById("binTable").innerHTML = html;

    InitMap(long, lat, 17);
    marker.setLngLat([long, lat]).addTo(map);
}

function InitMap(lng, lat, zoom){
    mapboxgl.accessToken = 'pk.eyJ1IjoiaGFycnlwb3J0ZXI5OCIsImEiOiJja3pkMmdsbWIwMzdjMnFucm5sd3ZieWZ4In0.aXsRiKXTFdjc7X4XBFcXOw';
    map = new mapboxgl.Map({
        container: 'map', // container ID
        style: 'mapbox://styles/mapbox/streets-v11', // style URL
        center: [lng, lat], // starting position [lng, lat]
        zoom: zoom // starting zoom
    });
}

function ConfigChart(dataList){
    data = JSON.parse(dataList);
    var jan = 0;
    var feb = 0;
    var mar = 0;
    var apr = 0;
    var may = 0;
    var jun = 0;
    var jul = 0;
    var aug = 0; 
    var sep = 0;
    var oct = 0;
    var nov = 0;
    var dec = 0;
    const months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'June', 'July', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']

    for(i = 0; i < data.length; i++){
        if(data[i].w_month == 1)
        {
            jan++;
            console.log(jan);
        }
        else if(data[i].w_month == 2)
        {
            feb++;
            console.log(feb);
        }
        else if(data[i].w_month == 3)
        {
            mar++;
        }
        else if(data[i].w_month == 4)
        {
            apr++;
        }
        else if(data[i].w_month == 5)
        {
            may++;
        }
        else if(data[i].w_month == 6)
        {
            jun++;
        }
        else if(data[i].w_month == 7)
        {
            jul++;
        }
        else if(data[i].w_month == 8)
        {
            aug++;
        }
        else if(data[i].w_month == 9)
        {
            sep++;
        }
        else if(data[i].w_month == 10)
        {
            oct++;
        }
        else if(data[i].w_month == 11)
        {
            nov++;
        }
        else if(data[i].w_month == 12)
        {
            dec++;
        }
    }

    if(isDrawn != false)
    {
        myChart.destroy();
    }
    
    const ctx = document.getElementById('chart').getContext('2d');
    isDrawn = true;
    myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: months,
            datasets: [{
                label: '# of Votes',
                data: [jan, feb, mar, apr, may, jun],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAsoectRation: false,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
}

function RemoveMarker(){
    marker.remove();
}