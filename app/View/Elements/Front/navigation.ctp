<?php
/**
 * Navigation element of Front panel
 */
?>
<!-- Collect the nav links, forms, and other content for toggling -->
<nav id="mainNav" class="navbar navbar-default navbar-fixed-top">
	<div class="container-fluid">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="row">
		<div class="navbar-header col-md-3 col-sm-3">
			<?php
				if (isset($userGroup)) {
					echo $this->Html->link($this->Html->image('logo.png', array('class'=>'logo','alt'=>'Foxhopr')),'/dashboard',array('class'=>'navbar-brand','escape' => false));
				} else {
					echo $this->Html->link($this->Html->image('logo.png', array('class'=>'logo','alt'=>'Foxhopr')),'/',array('class'=>'navbar-brand','escape' => false));
				}
				?>

		</div>
		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class=" col-md-6 col-sm-6" id="bs-example-navbar-collapse-1">
			
				<ul class="nav navbar-nav main-menu">
				<li><?php echo $this->Html->link('Tour',array('controller'=>'pages','action'=>'tour'),array('class'=>'page-scroll'))?></li>
				<li><?php echo $this->Html->link('FAQ',array('controller'=>'pages','action'=>'faq'),array('class'=>'page-scroll'))?> </li>
				
<!-- 				<li> <a class="page-scroll" href="#portfolio">Benefits</a> </li> -->
				<li> <a class="page-scroll" href="<?php echo Configure::read('SITE_URL').'blog/'?>">Blog</a> </li>
<!-- 				<li> <a class="page-scroll" href="javascript:void(0);">Pricing</a> </li> -->
				</ul>
		
			
		</div>

<nav class="login_left col-md-3 col-sm-3 text-right"> 
				<?php if(isset($isUserLogin) && !$isUserLogin){?>
				<a  data-wa-link="nav_login dropdown" href="<?php echo Configure::read('SITE_URL').'users/login'?>" style="color: rgb(0, 91, 244);"> <i class="fa fa-lock"></i> Log In </a> 
				<a class="active_btn" data-wa-link="nav_sign up dropdown" href="<?php echo Configure::read('SITE_URL').'users/sign-up'?>"> <i class="fa fa-lock"></i> Join Us </a>
				<?php } else {
                    if (isset($userGroup)) { ?>
                    <a  data-wa-link="nav_login dropdown" href="<?php echo Configure::read('SITE_URL').'businessOwners/profile'?>" style="color: rgb(0, 91, 244);"> MY PROFILE </a><?php } ?>
				<a class="active_btn" data-wa-link="nav_sign up dropdown" data-target="#logoutModal" data-toggle ="modal" href="javascript:void(0)"> Logout </a>
				<?php }?>				 
			</nav>


</div>

		<!-- /.navbar-collapse -->
	</div>
	<!-- /.container-fluid -->
</nav>

<button type="button" 
        class="navbar-toggle offcanvas-toggle" 
        data-toggle="offcanvas" 
        data-target="#js-bootstrap-offcanvas" 
        style="float:left; z-index:9">
  <span class="sr-only">Toggle Button</span>
  <span class="icon-bar"></span>
  <span class="icon-bar"></span>
  <span class="icon-bar"></span>
</button>


<nav class="navbar navbar-default navbar-offcanvas navbar-offcanvas-touch navbar-offcanvas-fade" role="navigation" id="js-bootstrap-offcanvas">
  <div class="container-fluid">
    <div class="navbar-header"> 
    <?php 
    echo $this->Html->link($this->Html->image('logo.png', array('class'=>'logo','alt'=>'Foxhopr')),'/dashboard',array('class'=>'navbar-brand','escape' => false));
    ?>
      <button type="button" class="navbar-toggle offcanvas-toggle pull-right" data-toggle="offcanvas" data-target="#js-bootstrap-offcanvas" style="float:left;"> <span class="sr-only">Toggle navigation</span> <i class="glyphicon glyphicon-remove"></i> </button>
    </div>
    <div>
    	<ul class="nav navbar-nav">
    	<li><?php echo $this->Html->link('Tour',array('controller'=>'pages','action'=>'tour'),array('class'=>'page-scroll'))?></li>
    		<li><?php echo $this->Html->link('FAQ',array('controller'=>'pages','action'=>'faq'),array('class'=>'page-scroll'))?> </li>
			
<!-- 			<li> <a class="page-scroll" href="javascript:void(0);">Benefits</a> </li> -->
			<li> <a class="page-scroll" href="<?php echo Configure::read('SITE_URL').'blog/'?>">Blog</a> </li>
<!-- 			<li> <a class="page-scroll" href="javascript:void(0);">Pricing</a> </li> -->
			<?php if(isset($isUserLogin) && !$isUserLogin){?>
				<li> <a class="page-scroll" href="<?php echo Configure::read('SITE_URL').'users/login'?>">Log In</a> </li>
    			<li> <a class="page-scroll" href="<?php echo Configure::read('SITE_URL').'users/sign-up'?>">Join Us</a> </li>
			<?php } else {
                if (isset($userGroup)) { ?>
                <li><a class="page-scroll" href="<?php echo Configure::read('SITE_URL').'dashboard'?>"> My Account </a></li>
                <?php } ?>
				<li><a class="page-scroll" data-target="#logoutModal" data-toggle ="modal" href="javascript:void(0)"> Logout </a></li>
			<?php }?>	
    		

    	</ul>
      
     <!-- <ul class="nav navbar-nav login-signup">
        <li><a class=" btn  loginbtn" data-wa-link="nav_login dropdown" href="#" style="color: rgb(0, 91, 244);"> <i class="fa fa-lock"></i> Log In </a></li>  
        <li><a class=" btn btn-primary signupbtn" data-wa-link="nav_sign up dropdown" href="#"> <i class="fa fa-lock"></i> Join Us </a></li>
      </ul>-->
    </div>
  </div>
</nav>



<?php if ($this->params['controller']=="pages" && $this->params['action']=='home') { 
	echo $this->Session->flash();
	//echo $this->HTML->css('video-js');
	//echo $this->HTML->script(array('http://vjs.zencdn.net/ie8/1.1.2/videojs-ie8.min.js', 'http://vjs.zencdn.net/5.8.0/video.js'));
?>
<!-- Header -->

<div id="myCarousel" class="carousel slide" data-ride="carousel">

		
			<div class="header-content-inner col-md-4  col-sm-6   col-xs-7 pull-right" id="networking_online">
				<h1 class="hero-title">Face-to-face business networking online. </h1>
				<p class="hero-subtitle">Meet. Share. Grow.</p>
				<!-- <a href="#about" class="btn btn-primary btn-xl page-scroll"> Join Us</a>  -->
				<?php echo $this->Html->link('Join Us',array('controller'=>'users','action'=>'sign-up'),array('class'=>'btn btn-primary btn-xl page-scroll'));?>
				
				<a href="#" class="play-btn"><img src="img/play.png">  &nbsp; Watch the video</a>
			</div>	
	<script>
	$(document).ready(function(){
		$('.play-btn').click(function(){
			
				$('#video_container').show();
			
		});
		
		$('.close-view').click(function(){
			$('#video_container').hide();
			
		
		});
	});
	</script>
		<div class="video" id="video_container">
			<a href="javascript:void(0);" class="close-view pull-right"><i class="fa fa-close"></i></a>
			<div class="col-md-12 text-center">
				<video controls preload="auto" width="80%" poster="<?php echo Configure::read('SITE_URL');?>img/profile.jpg">
                    <source src="<?php echo Configure::read('SITE_URL');?>FH_FINAL4.mp4" type='video/mp4'>                    
                  </video>
				  </div>
				  </div>
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
    <li data-target="#myCarousel" data-slide-to="1"></li>
    <li data-target="#myCarousel" data-slide-to="2"></li>
    <li data-target="#myCarousel" data-slide-to="3"></li>
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox">
    <div class="item active">
      <img src="img/slide1.jpg" alt="Chania">
      
    </div>

    <div class="item">
      <img src="img/slide2.jpg" alt="Chania">
    </div>
    <div class="item">
      <img src="img/slide3.jpg" alt="Flower">
    </div>

    <div class="item">
      <img src="img/slide4.jpg" alt="Flower">
    </div>
  </div>


</div>

<?php } else {
	echo $this->Session->flash();
}
?>
<div class="clearfix"></div>
<!-- Button trigger modal -->
<!-- Modal -->
<div class="fade modal modal-sm popup" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="logoutModalLabel" data-backdrop="static">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
              <div class="modal-header" style="border:none">
        </div>
        <div class="modal-body popup_body">
            <h2>
              Are you sure you want to Log Out ?            <div class="modal_text"></div>
        </h2></div>
        <div class="modal-footer popup_footer text-center">
            <button type="button" class="btn " data-dismiss="modal"><span class="pull-left">Cancel</span>  <!--<i class="fa fa-close "></i>--></button>
            <a class="btn " href="<?php echo Router::url(array('controller'=>'users', 'action'=>'logout'), true);?>"><span class="pull-left" >Ok</span>  <!--<i class="fa fa-check "></i>--></a>
        </div>
    </div>
  </div>
</div>
