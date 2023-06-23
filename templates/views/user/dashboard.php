<script src="https://www.gstatic.com/charts/loader.js">
</script>


<?php
    if (isset($_SESSION[ID])) {
        $session = new Session($_SESSION[ID]);
        $claimType = $session->getClaimTypeFromId($session->getCurrentUser()[CLAIM_ID]);

        // open container my-5
        echo '<div class="container my-5" id="sectionToDownload">';

            // title
            echo '<h2 class="text-center" style="color: black">Report vendite</h2>';

            // open row
            echo '<div class="row">';

                // sales report section
                echo '<div id="myChart" style="max-width:700px; height:400px">
                        <script type="text/javascript">
                            google.charts.load("current",{packages:["corechart"]});
                            google.charts.setOnLoadCallback(drawChart);
            
                            function drawChart() {
                                let data = google.visualization.arrayToDataTable([
                                    ["Price", "Size"],
                                    [50,7],[60,8],[70,8],[80,9],[90,9],[100,9],
                                    [110,10],[120,11],[130,14],[140,14],[150,15]
                                ]);
                                let options = {
                                    title: "Vendite",
                                    hAxis: {title: "Time"},
                                    vAxis: {title: "Amount"},
                                    legend: "none"
                                };
                                let chart = new google.visualization.LineChart(document.getElementById("myChart"));
                                chart.draw(data, options);
                            }
                        </script>
                    </div>';

                // order statistics -> open col-md-4
                echo '<div class="col-md-4">';

                    // get datetime now & yesterday
                    $datetimeNow = new DateTime();
                    $yesterday = $datetimeNow->modify('-1 day');

                    // get as string
                    $nowStr = $datetimeNow->format('Y-m-d H:i:s');
                    $yesterdayStr = $yesterday->format('Y-m-d H:i:s');

                    // today's order number
                    $todaySales = $session->getNumberOfDailyOrders();

                    // Today's order
                    echo '<div class="card my-3">
                            <div class="card-header">Vendite odierne</div>
                            <div class="card-body">
                                <h5 class="card-title">'. $todaySales .'</h5>
                            </div>
                        </div>';

                    // get month
                    $oneMonthAgo = $datetimeNow->modify('-30 day');

                    // get as string
                    $oneMonthAgoStr = $oneMonthAgo->format('Y-m-d H:i:s');

                    // month's order number
                    $monthOrderQty = $session->getOrdersQuantityInRangeDateTime($nowStr, $oneMonthAgoStr);

                    // Current Month Orders
                    echo '<div class="card my-3">
                            <div class="card-header">Vendite mensili</div>
                            <div class="card-body">
                                <h5 class="card-title">'. $monthOrderQty .'</h5>
                            </div>
                        </div>';

                    // get all orders
                    $allOrders = $session->getOrdersQuantity();

                    // Total Orders
                    echo ' <div class="card my-3">
                            <div class="card-header">Vendite totali</div>
                            <div class="card-body">
                                <h5 class="card-title">'. $allOrders .'</h5>
                            </div>
                        </div>';

                // order statistics -> close col-md-4
                echo '</div>';

                // Money balance without tax
                echo '  <div class="card my-3">
                            <div class="card-header">Fatturato giornaliero</div>
                            <div class="card-body">
                                <h5 class="card-title">'. EURO . ' ' . $session->getDailyTotalInvoices() . '</h5>
                            </div>
                        </div>';

                $tax = $session->getAllWarehouseTax();

                // Warehouse tax
                echo ' <div class="card my-3">
                        <div class="card-header">Spese di magazzino per metro cubo</div>
                        <div class="card-body">
                            <h5 class="card-title">'. EURO . ' ' . $tax . '</h5>
                        </div>
                    </div>';

                // Money balance without tax
                echo '  <div class="card my-3">
                            <div class="card-header">Fatturato annuale</div>
                            <div class="card-body">
                                <h5 class="card-title">'. EURO . ' ' . $session->getYearlyTotalInvoices() . '</h5>
                            </div>
                        </div>';

            // close row
            echo '</div>';

        // close container my-5
        echo '</div>';

        // open container
        echo "<div class='container'>";
            if ($claimType === CLAIM_SELLER_PR0_DESC) {
                echo "<button onclick='downloadSectionAsPdf()' class='btn btn-primary'>Scarica come PDF</button>";
            }
        // close container
        echo "</div>";

    } else {
        echo '<div>Non sembri essere loggato <a href="./login.php">Accedi</a>!</div>';
    }
?>




