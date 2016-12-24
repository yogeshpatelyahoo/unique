<?php if(array_sum($targetGroupGraphInfo)>0 || array_sum($actualGroupGraphInfo)>0){?>
<?php //echo $this->Html->script(array('Front/charts/Chart.min'))?>
<canvas id="canvas3" height="580" width="600"></canvas>
<?php
$targetData = (count($targetGroupGraphInfo)>3) ? array_shift($targetGroupGraphInfo) : $targetGroupGraphInfo;
$actualData = (count($actualGroupGraphInfo)>3) ? array_shift($actualGroupGraphInfo) : $actualGroupGraphInfo;
$barValueSpacing = 0;
switch (count($targetGroupGraphInfo)){
	case 1:
		$barValueSpacing = 90;
		break;
	case 2:
		$barValueSpacing = 25;
		break;
	case 3:
		$barValueSpacing = 10;
		break;
	default:
		$barValueSpacing = 90;
		break;
}
?>
<script>
var options = { 
	responsive : true,
	barValueSpacing:<?php echo $barValueSpacing?>,
	barDatasetSpacing : 5,
	multiTooltipTemplate: "<%= datasetLabel %> - <%= value %>"
};
    
var barChartData = {
	labels : ["<?php echo implode('","',array_keys($targetGroupGraphInfo))?>"],
	datasets : [
		{
			label: "Target",
			fillColor : "rgba(112,156,210,2)",
			strokeColor : "rgba(112,156,210,2.5)",
			data : [<?php echo implode(',',array_values($targetGroupGraphInfo))?>]
		},
		{
			label: "Actual",
			fillColor : "rgba(214,222,35,0.5)",
			strokeColor : "rgba(214,222,35,0.8)",
			data : [<?php echo implode(',',array_values($actualGroupGraphInfo))?>]
		}
	]
}
var ctx = document.getElementById("canvas3").getContext("2d");
window.myBar = new Chart(ctx).Bar(barChartData, options);
</script>
<?php }else{?>
<div class="empty-graph"><?php echo $this->Html->image('no-data.png',array('class'=>'img-responsive'))?></div>
<?php }