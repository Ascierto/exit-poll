<?php

include __DIR__ . '/includes/globals.php';

$count = \ExitPoll\Results::getCountVoters($_GET['id']);

$results = \ExitPoll\Results::getSumVoters($_GET['id']);

var_dump($results);


$dataPoints = array(
	array("label"=> "si", "y"=> $results[0]['somma_si']),
	array("label"=> "no", "y"=> $results[0]['somma_no']),

);

?>

<div class="container">
    <div class="row">
        <div class="col-12">
            <h2> Il numero totale di votanti è : <span class="text-danger h1 fw-bold">  <?php echo $count[0]['tot_voters'] ?></span></h2>
        </div>
    </div>
</div>


<div id="chartContainer" style="height: 370px; width: 100%;"></div>

<script>
window.onload = function () {
 
var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	exportEnabled: true,
	title:{
		text: "Average Expense Per Day  in Thai Baht"
	},
	subtitles: [{
		text: "Currency Used: Thai Baht (฿)"
	}],
	data: [{
		type: "pie",
		showInLegend: "true",
		legendText: "{label}",
		indexLabelFontSize: 16,
		indexLabel: "{label} - #percent%",
		yValueFormatString: "฿#,##0",
		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();
 
}
</script>

<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

</body>
</html>  