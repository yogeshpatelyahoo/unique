<style>
.live_feeds{position:relative;min-height:30px;max-height:380px;_height:expression(this.scrollHeight>899?"300px":"auto");overflow:auto;overflow-x:hidden;}
.live_feeds > div#rays {left: 30% !important;top: 30% !important;}
</style>
<div class="col-md-3 col-sm-3 myleft_panel">
	<div class="clearfix">&nbsp;</div>
	<div class="clearfix">&nbsp;</div>
	<div class="panel panel-default">
	<?php $tooltipText = '<ul><li>0-'.$membershipData[0]['Membership']['upper_limit'].': Warming Up </li>';
$tooltipText.= '<li>'.$membershipData[1]['Membership']['lower_limit'].'-'.$membershipData[1]['Membership']['upper_limit'].': Buzzin\' Around</li>'; 
$tooltipText.= '<li>'.$membershipData[2]['Membership']['lower_limit'].'-'.$membershipData[2]['Membership']['upper_limit'].': Now You\'re Cookin</li>';
$tooltipText.= '<li>'.$membershipData[2]['Membership']['upper_limit'].' plus: Fox-Hopping</li></ul>';?>
		<div class="panel-heading"><span><?php echo $level;?></span> <?php if($membershipUpdated==true && !$levelMessageViewed) {echo '<span class="new_badge">New</span>&nbsp; ';}?><i class="fa fa-info-circle custom_tooltip" data-placement="top" title="" data-original-title="<?php echo $tooltipText;?>"></i></div>
		<div class="rating-star2 text-center">
			<div id="stars-existing" class="starrr stars_rat star_color" data-rating=<?php echo $totalAvgRating;?>></div>  &nbsp;<br>
				<span><?php echo $totalReview;?> review(s)</span>
		</div>
	</div>
	<div class="panel panel-default">
		<div class="panel-heading">Updates</div>
		<div class="panel-body text-center panel_text live_feeds">
			<div id="rays" style="position:inherit;"><?php echo $this->Html->image('loding-logo.png',array('id'=>'liveFeedWait','class'=>'center-block img-responsive'));?></div>
		</div>
	</div>
	<div class="panel panel-default">
		<div class="panel-heading">Upcoming Events</div>
		<div class="panel-body text-center panel_text">
		<?php if(!empty($upcomingEvents) || !empty($taskList)) {
		    
		    if (!empty($upcomingEvents)) {
		?>
		<div class="event_text"><?php echo $upcomingEvents['Event']['title'];?></div>
			<div class="clearfix"></div>
			<div class="border_head">
				<div class="text_head">&nbsp;</div>
			</div>
		<?php }?>
		<?php if (!empty($taskList)) {
		    $i=1;
		foreach ($taskList as $task) {?>
			
			<div class="event_text"><?php echo $task['Task']['name'];?></div>
			<div class="clearfix"></div>
			<div class="border_head">
				<div class="text_head">&nbsp;</div>
			</div>
		
		<?php $i++;} } } else {echo 'No upcoming events';}?>
		</div>
		
	</div>
	<div class="panel panel-default webcast_dash">
		<div class="panel-heading">Newest Webcast</div>
		<?php if(!empty($webcast)) {
					$videoThumbnailArr = explode('v=', $webcast['Webcast']['link']);?>
		<div class="panel-body panel_text">
			<div class="media">
			
				<div class="media-left">
				<?php 
					echo $this->Html->link(
							$this->Html->image('http://img.youtube.com/vi/'.$videoThumbnailArr[1].'/mqdefault.jpg',array('width' => 99 , 'height'=>56)),
							array('controller' => 'events','action' => 'webcast',$webcast['Webcast']['id']),array('escape'=>false)
						);
				?>
				</div>
				<div class="media-body">
					<h4 class="media-heading"> <?php echo $webcast['Webcast']['title']; ?></h4>
					<div class="clearfix"></div>
					<?php echo date('M d, Y',strtotime($webcast['Webcast']['created']));?>
				</div>
				
			</div>
		</div>
		<?php 
			}else{
				echo '<div class="panel-body text-center panel_text">No webcast has been published by the administrator yet</div>';
			}
			?>
	</div>
	<div class="panel panel-default">	
		<div class="panel-heading">Profile Completion</div>
		<div class="panel-body text-center" style="background: #fff">
			<div class="progress My_progress">
				<div class="progress-bar progress-bar-success progress-bar-striped " role="progressbar"
					aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"
					style="width: <?php echo $percentage;?>%"><?php echo $percentage;?>%</div>
			</div>
			<div class="progresbar_text">
				<?php echo $this->Html->link ( 'Edit Profile', array (
						'controller' => 'businessOwners',
						'action' => 'profile',
						'edit' 
					), array (
						'style' => 'color:#F05A28' 
					) );
				?>
				<div class="pull-right persent"><?php echo $percentage;?>% Complete</div>
			</div>
		</div>
	</div>
	
	<!-- Fedback Form Starts -->
	<div class="panel panel-default">	
		<div class="panel-heading">Feedback for <img src="<?php echo $this->webroot;?>img/fox.png" width="23px"></div>
		<div class="panel-body " style="background: #fff">
		<div class="row">
		<div class="col-md-12">
		<?php echo $this->Form->create('Suggestion', array('url' => array('controller' => 'suggestions', 'action' => 'add'),'id'=>'suggestion_form'));
		echo $this->Form->textarea('message',array('class'=>'suggestion_box form-control','placeholder'=>'Post your suggestions here...'));
		echo $this->Form->button('Submit', array('type' => 'submit','class'=>"btn btn-sm file_sent_btn pull-right suggestions_btn"));
		echo $this->Form->end(); ?>
		</div>
		</div>
		</div>
	</div>
	<!-- Feedback Form Ends -->
	<?php 
	
	if(!empty($rightAds)) {?>
	<div class="advertisement">
	<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  
  <ol class="carousel-indicators">
  <?php for($i=0; $i<count($rightAds); $i++) {?>
    <li data-target="#carousel-example-generic" data-slide-to="<?php echo $i;?>" <?php if($i==0){echo 'class="active"';}?>></li>
    
    <?php }?>
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox">
  <?php 
  $i=0;
  foreach($rightAds as $rightAd) {
			$adImage = (!empty($rightAd['Advertisement']['ad_image'])) ? "uploads/ads/".$rightAd['Advertisement']['ad_image'] : "uploads/ads/right-ads.png";
			$adTitle = (!empty($rightAd['Advertisement']['title'])) ? ucfirst( $rightAd['Advertisement']['title'] ) : "";
			$adsurl = (!empty($rightAd['Advertisement']['target_url'])) ? $rightAd['Advertisement']['target_url'] : "";
			?>
    <div class="item <?php if($i==0){echo 'active';}?>">
    <?php if(!empty($adsurl)){
    	echo $this->Html->link($this->Html->image($adImage,array('title'=>$adTitle)), $adsurl, array('target'=>'blank','escape' => false));
    } else {
    	echo $this->Html->image($adImage,array('title'=>$adTitle));
    }
    ?>
    </div>
    <?php $i++;}?>
   
  </div>

  <!-- Controls -->
  <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
  
</div>
		
	</div>
	<?php }?>
</div>
<script> var action = 'listing';</script>
<?php echo $this->Html->script('Front/rating');?>
