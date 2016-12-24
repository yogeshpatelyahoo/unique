<?php echo $this->Html->css(array('flipclock/flipclock.css'));?>
<?php echo $this->Html->script(array('Front/flipclock/flipclock'));?>
<style>.notifydisable{display: none;}</style>
<div style="background:#fff; border:0; " class="inner_pages_heading">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="intro-text"> </div>
			</div>
		</div>
	</div>
</div>
<div class="clearfix"></div>
<section id="inner_pages_top_gap">
	<div class="container">    
		<div class="row margin_top_referral_search">       
			<div class="col-md-9">
				<div class="row">
					<div class="col-md-12 text-center">
						<?php 
						switch ($meetingAction) {
							case 'meetingstart':?>			
								<iframe id="meet" target="_top" src="https://foxhopr.adobeconnect.com<?php echo $slotData['AvailableSlots']['url_path'];?>?session=<?php echo $breezsessionValue;?>" height="610" width="862" frameborder="0"> 
								</iframe>
								
						<?php break;
							case 'meetingwaiting':
								echo '<h1>'.$message.'</h1>';
								echo '<label class="clock meetingwaiting"></label>';
								break;
							case 'alreadyended':
								echo '<h1>'.$message.'</h1>';
								break;
							case 'nomeeting':
								echo '<h1>'.$message.'</h1>';
								break;
							case 'begansoon':
								echo '<h1>'.$message.'</h1>';
								break;
						}
						?>
					</div>
				</div>
				<br>
				<br>
				<div class="row">
				<?php if($meetingAction == 'meetingstart') : ?>
					<div class="pull-left col-md-5"><h4>Your Team Event will End in:</h4><div class="clock"></div></div>					
				<?php endif;?>
				</div>
			</div>
			<?php echo $this->element("Front/loginSidebar",array('tabpage' => 'meeting'));?>
		</div>		
	</div>
	<?php echo $this->element('Front/bottom_ads');?>
</section>
<?php if(!empty($meetingAction)){
	echo '<input type="hidden" id="action" value="'.$meetingAction.'">';
	} else {
		$meetingAction = '';
	}
?>
<iframe id="loggedin" target="_top" src="about:blank" height="0" width="0" frameborder="0"></iframe>
<script>
var timeStart = '<?php echo $timeleftToStartMeeting;?>';
$( document ).ready(function() {
	/*$('#meet').load(function(){
		var iframe = document.getElementById("loggedin");
        iframe.src = "https://foxhopr.adobeconnect.com/api/xml?action=logout" // here goes your url
	});*/
	if($('#action').val() == 'meetingstart'){
		var intervalLength = 0;
		setInterval(function(){
			if(intervalLength == 0){
				var iframe = document.getElementById("loggedin");
				iframe.src = "https://foxhopr.adobeconnect.com/api/xml?action=logout" // here goes your url
			}
		intervalLength = 1;			
		}, 30000);
	}
	
	var opts = {
		clockFace: 'HourCounter',
		countdown: true,
		language: 'Custom',
		callbacks: {
        	stop: function() {
        		location.reload(true);
        	}
        }
	};
	opts.classes = {
		active: 'flip-clock-active',
		before: 'flip-clock-before',
		divider: 'flip-clock-divider',
		dot: 'flip-clock-dot',
		label: 'flip-clock-label',
		flip: 'flip',
		play: 'play',
		wrapper: 'flip-clock-small-wrapper'
	};
	$('.clock').FlipClock(parseInt(timeStart), opts);
});
</script>
