<?php if(!empty($graphData) ){
$colors = array("#9440ED", "#CB4B4B", "#46BFBD", "#09355C", "#FDB45C");
shuffle($colors);
$dataString = "";
$i=0;
foreach($graphData as $key=>$val) {
    if(strlen($key)>18) {
        $key = substr($key, 0, 15).'...';
    }
    if($val!=0) {
        $dataString .='{
                    value: '.$val.',
                    color: "'.$colors[$i].'",
                    label: "'.$key.'",
                },'; 
        $i++;
    }
}
if($dataString !='') {
?>
<div id="g5_legend" class="chart-legend"></div>
<div style="width: 240px;float: none;margin: 0 auto;">
<canvas id="canvas5d" height="240" width="240"></canvas></div>

<script type="text/javascript">
var pieData = [<?php echo $dataString;?>];
var myPie = new Chart(document.getElementById("canvas5d").getContext("2d")).Pie(pieData, {
    labelAlign: 'center',
    animation: false
});
document.getElementById('g5_legend').innerHTML = myPie.generateLegend();
</script>
<style>
#g5_legend li {
    list-style-type: none;
    display: inline-block;
    width: 50%;
}
#g5_legend li span{
    display: inline-block;
    width: 12px;
    height: 12px;
    margin-right: 5px;
}
</style>
<?php } else {?> <div class="empty-graph"><?php echo $this->Html->image('referral_graph_placeholder.png',array('class'=>'center-block img-responsive placeholder_img'))?></div><?php }?>
<?php }else{?>
<div class="empty-graph"><?php echo $this->Html->image('referral_graph_placeholder.png',array('class'=>'center-block img-responsive placeholder_img'))?></div>
<?php }