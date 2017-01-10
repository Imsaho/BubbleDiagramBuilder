
document.addEventListener("DOMContentLoaded", function () {

    // dodac warunek if(canvas.getContext())) !!!
    var canvas = document.getElementById("chart");
    var cxt = canvas.getContext("2d");

    cxt.fillStyle = "green";
    cxt.fillRect(10, 10, 100, 100);

    var zones = document.getElementsByTagName("tr");
    console.log(zones);

    var numberOfSides = 6,
            size = 20,
            Xcenter = 300,
            Ycenter = 300;

    cxt.beginPath();
    cxt.moveTo(Xcenter + size * Math.cos(0),
            Ycenter + size * Math.sin(0));
    
    for (var i=1; i<=numberOfSides; i++) {
        cxt.lineTo(Xcenter + size*Math.cos(i*2*Math.PI/numberOfSides),
            Ycenter + size*Math.sin(i*2*Math.PI/numberOfSides));
    }
});