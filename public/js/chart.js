$(document).ready(function() {
    $('.draw_chart').on('click', function () {
        drawChart();
    });
    drawChart();
});

function drawChart() {
    $.ajax({
        url: 'dataChart',
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            dataChart = data.datas;
            console.log(dataChart);
            google.charts.load('current', {'packages':['corechart']});
            google.charts.setOnLoadCallback(drawChart);

            function drawChart() {
                var data = google.visualization.arrayToDataTable(dataChart);
                var options = {
                    title: 'Ket qua',
                    curveType: 'function',
                    legend: { position: 'bottom' }
                };

                var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

                chart.draw(data, options);
            }
        }
    });
}



