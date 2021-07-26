<?php

include __DIR__ . '/includes/globals.php';

$count = \ExitPoll\Results::getCountVoters($_GET['id']);

$results = \ExitPoll\Results::getSumVoters($_GET['id']);



$poll  = \ExitPoll\Poll::showPoll($_GET);


$dataPoints = array(
	array("label"=> "si", "y"=> $results[0]['somma_si']),
	array("label"=> "no", "y"=> $results[0]['somma_no']),

);

?>


<div class="my-5" id="chartContainer" style="height: 80vh; width: 100%;"></div>

<script>
window.onload = function () {
 
var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	exportEnabled: false,
	title:{
		text: "<?php echo $poll[0]['name_poll'] ?>"
	},
	subtitles: [{
		text: "Il numero dei votanti è : <?php echo $count[0]['tot_voters'] ?>"
	}],
	data: [{
		type: "pie",
		showInLegend: "true",
		legendText: "{label}",
		indexLabelFontSize: 16,
		indexLabel: "{label} - #percent%",
		yValueFormatString: "##0",
		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();
 
}
</script>

<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

</body>
</html>  