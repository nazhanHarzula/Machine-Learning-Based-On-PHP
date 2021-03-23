function myFunctionGraph(indexGraph){
    
    document.getElementById("chartUsia").style.display = "block";
    valueIndexChoosenForGraph = document.getElementById("numberIndexGraph").value;

    var dataPoints = [];

    var chartUsia = new CanvasJS.Chart("chartUsia", {
        animationEnabled: true,
        exportEnabled: true,
        title: {
            text: indexGraph.options[indexGraph.selectedIndex].text
        },
        data: [{
            type: "column",
            toolTipContent: "{y}",
            dataPoints: dataPoints
        }]
    });

    $.get("Dataset_Final_Baru.csv", getDataPointsFromCSV);

    //CSV Format
    function getDataPointsFromCSV(csv) {
        var csvLines = points = [];
        csvLines = csv.split(/[\r?\n|\r|\n]+/);
        for (var i = 0; i < csvLines.length; i++) {
            if (csvLines[i].length > 0) {
                points = csvLines[i].split(",");
                dataPoints.push({
                    label: points[0],
                    y: parseFloat(points[parseInt(valueIndexChoosenForGraph)])
                });
            }
        }
        chartUsia.render();
    }
}