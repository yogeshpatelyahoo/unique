<?php
/**
 * Responsible for frontend layout
 */
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
	<meta name="google-site-verification" content="WKZPjEDO1Y5QGUR-clx9fbb5SLLxdH0XQDIZPebSOK0" />
	<meta name="robots" content="noindex">
	<meta name="googlebot" content="noindex">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php if (!empty($metaDescription)) { ?>
    <meta name="description" content="<?php echo $metaDescription; ?>" />
  	<?php } ?>
  	<?php if (!empty($metaKeywords)) { ?>
    <meta name="keywords" content="<?php echo $metaKeywords; ?>" />
  	<?php } ?>
  	<link rel="icon" type="image/x-icon" href="<?php echo $this->Html->url('/img/favicon.ico');?>">
    <meta name="author" content="">
    
    <title>		
		<?php echo $titleForLayout = (isset($titleForLayout)) ? $titleForLayout : 'Foxhopr'; ?>		
	</title> 
    <?php
		echo $this->Html->meta('icon');
		if ($this->params['controller'] == "pages" /*&& $this->params['action'] == "home"*/) {
			echo $this->Html->css(array('bootstrap.min','font-awesome/css/font-awesome.min.css','home/designer.css','home/designer-responsive.css','home/bootstrap.offcanvas.css','../assets/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch','../assets/plugins/bootstrap-modal/css/bootstrap-modal'));	
	    } else {
	    	echo $this->Html->css(array('https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css','bootstrap.min','fonts','sass-compiled','developer','bootstrap-multiselect','../assets/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch','../assets/plugins/bootstrap-modal/css/bootstrap-modal','animate','custom.css','responsive','home/bootstrap.offcanvas.css'));
			if ($this->params['controller'] != "pages" && $this->params['action'] != "home") {
				echo $this->Html->css(array('header-footer-inner-pages.css','designer-responsive-innerpages.css'));
		    }
	    }
		
		echo $this->Html->script(array('Front/jquery','/assets/plugins/jquery-validation/dist/jquery.validate.min','Front/jquery.form','Front/front_validation','Front/infinitescroll.min','Front/bootstrap-multiselect', '/assets/plugins/blockUI/jquery.blockUI.js', 'all.js','Front/home/bootstrap.offcanvas'));
		if(!empty($validationJs)){
		        foreach ($validationJs as $jsFile){
		            echo $this->Html->script('Front/validations/'.$jsFile);
		        }
		    }
		   echo $this->Html->script('Front/bxslider/jquery.bxslider');
		    echo $this->Html->css('jquery.bxslider');
		echo $this->Html->scriptBlock('var BASE_URL = '.$this->Js->object(Configure::read('SITE_URL')).';'); 
		echo $this->Html->scriptBlock('var PAGE = '.$this->Js->object($this->params['controller']).';');
  	?>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    
 <!--- For Country State -->
		<?php if($this->params['controller'] != 'dashboard'){	
        echo $this->Html->css('jQueryUI'); }?>
<!--<link href="http://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel="stylesheet">-->
<script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<!-- End-->
</head>
<body id="page-top" class="index">
<div id="page-preloader" style="display:none;"></div>
<div id="preloader" style="display:none;"></div>
<?php echo $this->element("Front/navigation");
    if ($leaderAlertMsg && ($this->action != 'reactivate' && $this->action != 'home')) { ?>
        <div class="container topspace col-md-12 ">
            <div class="alert alert-warning" id="leaderAlertMsg">Please watch the training video to unlock the group leader/co-leader rights.<?php echo $this->Html->link('Click Here', array('controller' => 'businessOwners', 'action' => 'trainingVideo'), array('style' => 'color:#709cd2; font-weight:bold;')); ?> to watch the video.</div>
        </div>
    <?php } ?>

<?php 
$menuPages = array('dashboard','team','referrals','messages','events','contacts','accounts','reviews','teams','businessOwners');
$notinclude = array('rating','start');
if(isset($isUserLogin) && $isUserLogin && $this->Session->check('UID') == false && in_array($this->params['controller'],$menuPages) && !in_array($this->params['action'],$notinclude)) {
  echo $this->element("Front/loginNavigation");
}
?>
<?php echo $this->fetch('content'); ?>
<?php echo $this->element("Front/footer");?>