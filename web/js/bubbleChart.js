
document.addEventListener("DOMContentLoaded", function () {

    var canvas = document.getElementById("chart");
    var paper = new Raphael(canvas, 1500, 600);
    var chartItems = document.querySelectorAll('tr[data-chart="true"]');

    function drawBubbleChart(numberOfSides, size, Xcenter, Ycenter, allItemsData) {

        for (var i = 1; i <= numberOfSides; i++) {

            var radius = Math.sqrt(allItemsData[i - 1]["chartArea"] / Math.PI) * 35;
            var info = allItemsData[i - 1]["name"];

            paper.circle(Xcenter + size * Math.cos(i * 2 * Math.PI / numberOfSides),
                    Ycenter + size * Math.sin(i * 2 * Math.PI / numberOfSides), radius)
                    .attr({fill: allItemsData[i - 1]["color"], stroke: "none", opacity: 0.85})
                    .data("name", allItemsData[i-1]["name"])
                    .data("area", allItemsData[i-1]["area"])
                    .click(function () {

                        console.log(this.data("name") + ", "
                + this.data("area") + (' m\xB2'));
                    });
        }
    }

    var allItemsData = [];
    for (var i = 0; i < chartItems.length; i++) {
        allItemsData.push(chartItems[i].dataset);
    }

    var totalArea = 0;
    for (var i = 0; i < allItemsData.length; i++) {
        totalArea += Number(allItemsData[i]['area']);
    }

    for (var i = 0; i < allItemsData.length; i++) {
        allItemsData[i]['chartArea'] = allItemsData[i]['area'] / totalArea * 100;
    }

    console.log(allItemsData);

    var numberOfSides = chartItems.length,
            size = 170,
            Xcenter = 300,
            Ycenter = 300;

    drawBubbleChart(numberOfSides, size, Xcenter, Ycenter, allItemsData);

});