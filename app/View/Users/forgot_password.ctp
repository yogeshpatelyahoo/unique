<?php 
$error_class = "";
$error_class = $this->Session->flash('error');
if ($error_class){
	$error_class = "error";
}
?>
<!-- Header -->
<div class="inner_pages_heading" style="background: #fff; border: 0">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="intro-text"></div>
			</div>
		</div>
	</div>
</div>
<div class="clearfix"></div>
<section id="inner_pages_top_gap">
	<div class="container">
		<div class="row">
			<div class="col-sm-12 ">
				<div class="become_head">
					<div class="login_head">Forget Your Password?</div>
					<div class="clearfix"></div>
					<p class="forgot_informative">Enter your email address to reset your password. You may need to check your spam folder </p>
				</div>
			</div>
		</div>
		<div class="row"></div>
		<div class="row location_search_margin_top margin0_420">
			<div class="col-md-6 col-xs-12 col-sm-6  col-md-offset-3  col-sm-offset-3">
        	<?php echo $this->Form->create('User',array('id'=>'forgetPasswordForm','type'=>'post','url'=>array('controller'=>'users','action'=>'forgotpassword'),'class'=>'login_form','inputDefaults' => array('label' => false,'div' => false,'errorMessage'=>true),'novalidate'=>true));?>
        		<div class="form-group">
					<label for="exampleInputPassword1">Email*</label> 
					<?php echo $this->Form->input('email',array('type'=>'text','id'=>'emailid','placeholder'=>"John.Smith@gmail.com",'autofocus'=>true,'class'=>"form-control {$error_class}"));?>
				</div>				
				<div class="clearfix">&nbsp;</div>
				<div class="col-xs-12  text-center">
					<?php echo $this->Form->button('Submit',array('class'=>'next-step-btn', 'type'=>'submit'));?>					
				</div>
				<div class="clearfix"></div>				
				<div class="clearfix"></div>
            <?php echo $this->Form->end();?>
      		</div>
			<div class="clearfix"></div>
		</div>
		<div class="clearfix"></div>
	</div>
</section>
<div class="clearfix"></div>
<div class="clearfix"></div>