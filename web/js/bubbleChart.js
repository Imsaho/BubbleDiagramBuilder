
document.addEventListener("DOMContentLoaded", function () {

    var canvas = document.getElementById("chart");
    if (canvas.getContext("2d")) {
        var cxt = canvas.getContext("2d");
        cxt.globalAlpha = 0.8;

        var chartItems = document.querySelectorAll('tr[data-chart="true"]');

        var allItemsData = [];
        for (var i = 0; i < chartItems.length; i++) {
            allItemsData.push(chartItems[i].dataset);
        }
        console.log(allItemsData);

        var numberOfSides = chartItems.length,
                size = 120,
                Xcenter = 300,
                Ycenter = 250;

        cxt.moveTo(Xcenter + size * Math.cos(0),
                Ycenter + size * Math.sin(0));

        for (var i = 1; i <= numberOfSides; i++) {
            
            cxt.beginPath();
            cxt.fillStyle = allItemsData[i-1]["color"];
//            console.log(cxt.fillStyle);
            
            cxt.moveTo(Xcenter + size * Math.cos(i * 2 * Math.PI / numberOfSides),
                    Ycenter + size * Math.sin(i * 2 * Math.PI / numberOfSides));

            cxt.arc(Xcenter + size * Math.cos(i * 2 * Math.PI / numberOfSides),
                    Ycenter + size * Math.sin(i * 2 * Math.PI / numberOfSides), 100, 0, 2 * Math.PI);
            cxt.fill();
        }

        cxt.strokeStyle = "red";
        cxt.lineWidth = 1;
    }
});