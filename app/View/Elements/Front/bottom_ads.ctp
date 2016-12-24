
<div class="clearfix">&nbsp;</div>
<?php if( !empty($bottomAds) ) {?>
<div class="container">
	<div class="row">
	<div class="col-md-3"></div>
		<div class="col-md-6 bottom_advert">
		<div id="carousel-example-generic-1" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  
  <ol class="carousel-indicators">
  <?php for($i=0; $i<count($rightAds); $i++) {?>
    <li data-target="#carousel-example-generic-1" data-slide-to="<?php echo $i;?>" <?php if($i==0){echo 'class="active"';}?>></li>
    
    <?php }?>
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox">
  <?php 
  $i=0;
  foreach($bottomAds as $bottomAd) {
			$adImage = (!empty($bottomAd['Advertisement']['ad_image'])) ? "uploads/ads/".$bottomAd['Advertisement']['ad_image'] : "uploads/ads/bottom-ads.png";
			$adTitle = (!empty($bottomAd['Advertisement']['title'])) ? ucfirst( $bottomAd['Advertisement']['title'] ): "";
			$adsurl = (!empty($bottomAd['Advertisement']['target_url'])) ? $bottomAd['Advertisement']['target_url'] : "";
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
  <a class="left carousel-control" href="#carousel-example-generic-1" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#carousel-example-generic-1" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
  
</div>	
		</div>
		<div class="col-md-3"></div>
	</div>
</div>
<?php }?>
