document.addEventListener("keyup", function(event){
    if (event.code === "Enter") {
        PopUp()
    }
});

function PopUp(){

    var username = "admin";
    var password = "password";

    var nameInput = document.getElementById("username").value;
    var passInput = document.getElementById("password").value;
    
    if (nameInput == username && passInput == password) {
        document.getElementById("alertText").style.display = "none";
        // window.alert("Signed in");
        window.location.replace("test.php");
    }
    else{
        document.getElementById("alertText").style.display = "block";
    }
}

