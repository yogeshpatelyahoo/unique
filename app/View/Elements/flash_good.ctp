<!-- <div id="notification_bar" class="alert alert-success" style="margin-top:40px;"><?php echo $message; ?></div> -->
<div class="alert alert-success" id="flashMessage"><button data-dismiss="alert" class="close">x</button><?php echo $message; ?></div>
 <script type="text/javascript">
	jQuery(document).ready(function () {
		$('#flashMessage').slideDown();
		setTimeout(function(){
			$("#flashMessage").html("");
			$('#flashMessage').slideUp();
		}, 5000);
	});
</script> 
