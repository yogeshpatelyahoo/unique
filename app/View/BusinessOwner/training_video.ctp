<div class="row margin_top_referral_search">
    <div class="col-md-9 col-sm-8 ">      
        <div class="clearfix">&nbsp;</div>
        <input id="videoPlayTime" value="1" type="hidden"></input>
        <div class="video_here training_video">
        <?php 
        if(!empty($video['Trainingvideo']['video_name'])){?>
        	<img id="playbutton" onclick="checkDuration('play');" src="../img/play-video.png" class="play-video" />
          
        
            <?php echo $this->Html->media(array('../trainingvideo/'.$video['Trainingvideo']['video_name']),array('autoplay','id'=>'video1','width'=>836)
                ); ?>
        <?php } else {?>
        	<h3 align="center" class="no_videos">No training video found</h3>
        <?php }?>
        

            </div>   


        </div>
        <?php echo $this->element("Front/loginSidebar",array('tabpage' => 'videotraining'));?>
    </div>
    <?php
    echo $this->Html->script ( 'Front/trainingvideo' );