<script
        src="https://www.gstatic.com/charts/loader.js">
</script>


<!-- Sales Report Section -->
<div class="container my-5">
    <h2 class="text-center">Sales Report</h2>
    <div class="row">
        <!-- Sales Chart -->
        <div id="myChart" style="max-width:700px; height:400px">
            <script type="text/javascript">
                google.charts.load('current',{packages:['corechart']});
                google.charts.setOnLoadCallback(drawChart);

                function drawChart() {
                    let data = google.visualization.arrayToDataTable([
                        ['Price', 'Size'],
                        [50,7],[60,8],[70,8],[80,9],[90,9],[100,9],
                        [110,10],[120,11],[130,14],[140,14],[150,15]
                    ]);
                    let options = {
                        title: 'House Prices vs Size',
                        hAxis: {title: 'Square Meters'},
                        vAxis: {title: 'Price in Millions'},
                        legend: 'none'
                    };
                    let chart = new google.visualization.LineChart(document.getElementById('myChart'));
                    chart.draw(data, options);
                }
            </script>
        </div>

        <!-- Order Statistics -->
        <div class="col-md-4">
            <!-- Today's Orders -->
            <div class="card my-3">
                <div class="card-header">Today's Orders</div>
                <div class="card-body">
                    <h5 class="card-title">10</h5>
                </div>
            </div>
            <!-- Current Month Orders -->
            <div class="card my-3">
                <div class="card-header">Current Month Orders</div>
                <div class="card-body">
                    <h5 class="card-title">100</h5>
                </div>
            </div>
            <!-- Total Orders -->
            <div class="card my-3">
                <div class="card-header">Total Orders</div>
                <div class="card-body">
                    <h5 class="card-title">1000</h5>
                </div>
            </div>
        </div>
    </div>
    <!-- Total Money -->
    <div class="card my-3">
        <div class="card-header">Total Money</div>
        <div class="card-body">
            <h5 class="card-title">$10000</h5>
        </div>
    </div>
</div>
