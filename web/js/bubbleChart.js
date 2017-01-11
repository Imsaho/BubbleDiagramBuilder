
document.addEventListener("DOMContentLoaded", function () {

    var canvas = document.getElementById("chart");
    var chartItems = document.querySelectorAll('tr[data-chart="true"]');

    function drawBubbleChart(numberOfSides, size, Xcenter, Ycenter, allItemsData) {
        cxt.moveTo(Xcenter + size * Math.cos(0),
                Ycenter + size * Math.sin(0));

        for (var i = 1; i <= numberOfSides; i++) {

            cxt.beginPath();
            cxt.fillStyle = allItemsData[i - 1]["color"];
            var radius = Math.sqrt(allItemsData[i-1]["chartArea"] / Math.PI )*35;

            cxt.moveTo(Xcenter + size * Math.cos(i * 2 * Math.PI / numberOfSides),
                    Ycenter + size * Math.sin(i * 2 * Math.PI / numberOfSides));

            cxt.arc(Xcenter + size * Math.cos(i * 2 * Math.PI / numberOfSides),
                    Ycenter + size * Math.sin(i * 2 * Math.PI / numberOfSides), radius, 0, 2 * Math.PI);
            cxt.fill();
        }
    }

    if (canvas.getContext("2d")) {
        var cxt = canvas.getContext("2d");
        cxt.globalAlpha = 0.8;

        var allItemsData = [];
        for (var i = 0; i < chartItems.length; i++) {
            allItemsData.push(chartItems[i].dataset);
        }
//        console.log(allItemsData);
        
        var totalArea = 0;
        for (var i=0; i<allItemsData.length; i++) {
            totalArea += Number(allItemsData[i]['area']);
        }
//        console.log(totalArea);
        
        for (var i=0; i<allItemsData.length; i++) {
            allItemsData[i]['chartArea'] = allItemsData[i]['area'] / totalArea * 100;
        }
        
//        console.log(allItemsData);

        var numberOfSides = chartItems.length,
                size = 170,
                Xcenter = 300,
                Ycenter = 300;

        drawBubbleChart(numberOfSides, size, Xcenter, Ycenter, allItemsData);
    }
});