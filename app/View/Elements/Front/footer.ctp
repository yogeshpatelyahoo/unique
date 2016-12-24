<?php
/**
 * Front end footer
 */
?>
<style>
  .modal {
    background-clip: padding-box;
    background: none;
    border: none;
    border-radius: 0;
    bottom: auto;
    box-shadow: none;
    left: 50%;
    margin-left:none;
    padding: none;
    right: auto;
    width: auto;
}
.modal-scrollable{background:rgba(0,0,0,0.1)}
</style>
</div></div></section>
<div id="popup" class="modal fade modal-sm" tabindex="-1" data-width='auto' style="display: none;">
</div>
<div data-backdrop="static" data-keyboard="false" class="modal fade popup" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;">
</div>
<div class="modal fade popup" id="myModalNoRecord" tabindex="-1" role="dialog" aria-hidden="true">
  <div role="document" class="modal-dialog">
    <div class="modal-content">
      <div style="border:none" class="modal-header">
      </div>
      <div class="modal-body popup_body">
        <h2>Please select atleast one record</h2>
      </div>
      <div class="modal-footer popup_footer text-center">
        <button data-dismiss="modal" class="btn btn-default ok_btn" type="button"><span class="pull-left">Ok</span></button>
      </div>
    </div>
  </div>
</div>
<!-- Model -->
<div class="modal fade popup" id="modelLeaderunlock" tabindex="-1" role="dialog" aria-hidden="true">
  <div role="document" class="modal-dialog">
    <div class="modal-content">
      <div style="border:none" class="modal-header">
      </div>
      <div class="modal-body popup_body">
        <h2>Please watch the training video to unlock the group leader/co-leader rights</h2>
      </div>
      <div class="modal-footer popup_footer text-center">
        <button data-dismiss="modal" class="btn btn-default ok_btn" type="button"><span class="pull-left">Ok</span></button>
      </div>
    </div>
  </div>
</div>
<!-- Model -->
<!-- Task Modal -->
<!-- Modal -->
<div data-backdrop="static" data-keyboard="false" class="modal fade" id="taskModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="left: 44%;">
  <div class="modal-dialog" role="document">
    <div class="modal-content task_model_body">
      <!-- Modal Content here -->
    </div>
  </div>
</div>
<!-- Contact Section -->

<?php if ($this->params['controller'] == 'pages' && (in_array($this->params['action'], array('home')))) {?>
<!-- <section id="contact">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 text-center">
				<h2>Get in touch with us!</h2>
			</div>
		</div>
		<div class="row">
			<div class=" col-md-12 ">
				<?php echo $this->Form->create('NewsletterSubscribe', array('url' => Router::Url(array('controller' => 'newsletters','action' => 'subscribe'), TRUE), 'id' => 'NewsletterSubscribeForm','role'=>"search"));  ?>					
					<div class="input-group">
						<?php echo $this->Form->input('subscribe_email_id',array('id'=>'subscribe_email_id','type'=>'text','class'=>'form-control subscribe_search','maxlength'=>'64','placeholder'=>'Enter your email address','label'=>false))?>
						<div class="input-group-btn">
							<?php echo $this->Form->button('Subscribe', array('type' => 'submit','class'=>'btn btn-default subscribe_btn'));?>
						</div>
					</div>
				<?php echo $this->Form->end(); ?>
			</div>
		</div>
	</div>
</section> -->

		<aside class="bg-dark">
			<div class="container text-center">
				<div class="join-us">
					<h2>Get in touch with us!</h2>
					<?php echo $this->Html->link('<i class="fa fa-lock"></i> Join Us Now',array('controller'=>'users','action'=>'sign-up'),array('class'=>'btn btn-default btn-xl btn-primary', 'escape'=>false));?>
				</div>
			</div>
		</aside>
<?php } ?>
<footer class="footer">
	<div class="container">
		<div class="row">
			<div class="col-lg-8 col-lg-offset-2 text-center"> 
			<a href="<?php echo Configure::read('SITE_URL');?>" class="logo-footer">
			<?php echo $this->Html->image('logo-bottom.png', array('alt'=>'Foxhopr'));?>
			</a>
				<div class="clearfix"></div>
				<div class="social-links">
					<a target="_blank" class="social-link" href="https://www.facebook.com/foxhopr"><span class="fa fa-facebook"></span></a>
					<a target="_blank" class="social-link" href="https://twitter.com/foxhopr"><span class="fa fa-twitter"></span></a>
					<a target="_blank" class="social-link" href="http://linkedin.com/company/foxhopr"><span class="fa fa-linkedin"></span></a>
					<a target="_blank" class="social-link last" href="#"><span class="fa fa-google-plus"></span></a>
					</div>
					<div class="clearfix"></div>   
					<div class="menu-primary">
						<ul class="footer-primary-menu inline">
							<li class="menu-3866 first"><?php echo $this->Html->link('About Us', array('controller' => 'pages', 'action' => 'about-us'), array('escape' => false));?></li>
							<li class="menu-3871"><a href="<?php echo Configure::read('SITE_URL');?>blog">Blog</a></li>
							<li class="menu-3876"><a href="#">Affiliates</a></li>
							<li class="menu-3881">
							<?php echo $this->Html->link('Contact', array('controller' => 'pages', 'action' => 'contact-us'), array('escape' => false,'class'=>'canadian-flag'));?>
							</li>
<!-- 							<li class="menu-20001"><a href="#">Careers</a></li> -->
							<li class="menu-20002 last"><a href="#">Press</a></li>
						</ul>    
					</div>
					<div class="menu-secondary">
						<ul class="footer-secondary-menu inline">
							<li class="menu-3886 first"><a href="#">Download for iOS</a></li>
							<li class="menu-3891"><a href="#">Download for Android</a></li>
							<li class="menu-3896">
								<?php echo $this->Html->link('FAQ', array('controller' => 'pages', 'action' => 'faq'), array('escape' => false));?>
							</li>
							<li class="menu-3901">
								<?php echo $this->Html->link('Adobe Support', array('controller' => 'pages', 'action' => 'contact-us'), array('escape' => false));?>
							</li>
						</ul>    
					</div>
					<small class="copyright">

						<p><br></p>
						<p>&copy; 2016 Unique. All rights reserved.</p>
						<div align="center">
							<ul class="footer-secondary-menu inline">
								<li class="menu-3886 first">
									<?php echo $this->Html->link('Terms', array('controller' => 'pages', 'action' => 'terms-of-services'), array('escape' => false)); ?>
								</li>
								<li class="menu-3891">
									<?php echo $this->Html->link('Privacy Policy', array('controller' => 'pages', 'action' => 'privacy-policy'), array('escape' => false)); ?>
								</li>
							</ul>  
						</div>
					</small>
				</div>
			</div>
		</div>
	</footer>
<!-- Coupon Slider -->
<?php if(isset($couponData) && !empty($couponData)){ ?>
<div class="toggel_div coupon_slide">
	<div id="toggle-right" style="width:0"> 
		<div class="teggle_text">
			<p>Receive <?php echo $couponData['Coupon']['discount_amount']?>% discount on signup  </p>
			<p style="text-align: center;"><a href="<?php echo Router::url(array('controller'=>'users', 'action'=>'sign-up'), true);?>">Join Us</a></p>
			<p>Use coupon code :  </p>
			<p class="text-center code-text"> <b><?php echo $couponData['Coupon']['coupon_code']?></b></p>
			<p class="expires">Expires on : <?php echo date('m-d-Y',strtotime($couponData['Coupon']['expiry_date']))?></p>
		</div>
	</div>
	<?php echo $this->Html->link($this->Html->image("toggle.png"),"javascript:void(0)",array('escape' => false,'id'=>'right_btn'));?>
</div>
<?php } ?>
<!-- coupon Slider -->

<!-- Scroll to Top Button (Only visible on small and extra-small screen sizes) -->
<div class="scroll-top page-scroll visible-xs visible-sm">
	<a class="btn btn-primary" href="#page-top"> <i
		class="fa fa-chevron-up"></i>
	</a>
</div>
<?php echo $this->Html->script(array('Front/bootstrap.min','Front/jquery.easing.min',/*'Front/classie','Front/cbpAnimatedHeader','Front/freelancer.js','cbpAnimatedHeader.js'*//*'classie.js',*/'../assets/plugins/bootstrap-modal/js/bootstrap-modal','../assets/plugins/bootstrap-modal/js/bootstrap-modalmanager','../assets/js/ui-modals'/*,'Front/script.js'*/));?>


<script type="text/javascript">
var ajaxModelUrl = "<?php echo Router::url(array('controller'=>'events','action'=>'get-model-data'));?>";  
$( ".underline" ).hover(function() {
  $( "#testdiv" ).fadeIn(1300);
});
$( "#closebtn" ).click(function() {
  $( "#testdiv" ).hide();
});
$( ".pic" ).hover(function() {
 ulid = $(this).attr('id');
 $( ".testimonial-right" ).hide();	
 $( "#text" + ulid).show();
 
});
$(document).ready(function(){
	//Navigation Menu Slider
    /*$('#nav-expander').on('click',function(e){
  		e.preventDefault();

  		$('body').toggleClass('nav-expanded'); 
		  var isOut = $('body').hasClass('nav-expanded');
  		$('body').animate({marginLeft: isOut? '-300px' : '0'}, 500)

  		
  	});
  	$('#nav-close').on('click',function(e){
  		e.preventDefault();
  		$('body').removeClass('nav-expanded');
  		 var isOut = $('body').hasClass('nav-expanded');
  		$('body').animate({marginLeft: isOut ? '0px' : '0px'}, 900)
  		
  	});*/
  	
	$('form').attr('autocomplete','off');
	if ($('#right_btn').length) {
	  var toggled = true;
		$( "#right_btn" ).click(function() {
			if(!toggled){
				toggled = true;
				$( "#toggle-right" ).animate({width: "0px"}, 1000);		
			}else{
				toggled = false;
				$( "#toggle-right" ).animate({width: "285px"}, 1000);	
			}
		});
	}
	var tmp = $.fn.tooltip.Constructor.prototype.show;
	$.fn.tooltip.Constructor.prototype.show = function () {
	  tmp.call(this);
	  
	  if (this.options.callback) {
	    this.options.callback();
	  }
	}
	$('[data-toggle="tooltip"]').tooltip();
	$('.custom_tooltip').tooltip({
	     html: true,
		  callback: function() { 
			  var postUrl = "<?php echo Router::url(array('controller'=>'businessOwners','action'=>'ajaxUpdateLevelMembership'))?>";
			  $.ajax({
	                'type': 'post',
	                'data': {'update':'membershil_popup'},
	                'url': postUrl,
	                success: function (msg) {
		                	                    
	                }
	            });
		  } 
		});
	<?php if(isset($search) && $search!='') {?>
    $('.clearable').addClass('x');
  <?php }?>
});
</script>
<?php if($this->params['controller'] == 'events') {
 echo $this->Html->css('../assets/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min');
echo $this->Html->css('../assets/plugins/bootstrap-datepicker/css/datepicker.css');
echo $this->Html->script('http://jdewit.github.io/bootstrap-timepicker/js/bootstrap-timepicker.js');
echo $this->Html->script('../assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js');?>
<script>
function loadModel(taskID, type) {
    if(taskID=='') {
    	taskID = null;
    }    	
    $.ajax({
        'type': 'post',
        'data': {'taskId': taskID, 'action' : type},
        'url': ajaxModelUrl,
        success: function (data) {
            $('.task_model_body').html(data);
        }
    });
}
</script>
<?php }?>
<?php echo $this->Js->writeBuffer(); ?>
</body>
</html>
