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
		<div class="row ">
			<div class="col-sm-12 ">
				<div class="become_head">
					<div class="login_head">Log In</div>
				</div>
				
			</div>
		</div>
		<div class="clearfix">&nbsp;</div>
		<div class="row">
	<div class="col-md-8 col-xs-12 col-sm-10 col-lg-6   col-lg-offset-3  col-md-offset-2  col-sm-offset-1 socialable">
		<div class="social-signup">
         <div class="col-md-6 col-xs-12 col-sm-6 ">
        <a class="btn-connect-option facebook badge-facebook-connect" href="<?php echo Router::url(array('controller'=>'users', 'action'=>'do-facebook-login'));?>">Log In with Facebook</a>
        </div>
         <div class="col-md-6 col-xs-12 col-sm-6 ">
        <a class="btn-connect-option linkedin badge-linkedin-connect-btn" href="<?php echo Router::url(array('controller'=>'users', 'action'=>'do-linked-in-login'));?>">Log In with LinkedIn</a>
        </div>
            </div>
            <div class="seperation">
					<span>OR</span>
				</div>
		</div>
		</div>
		<div class="row ">
			<div class="col-md-8 col-xs-12 col-sm-10 col-lg-6   col-lg-offset-3  col-md-offset-2  col-sm-offset-1">
        	<?php echo $this->Form->create('User',array('id'=>'loginUserForm','type'=>'post','url'=>array('controller'=>'users','action'=>'login'),'class'=>'login_form', 'autocomplete'=>'off', 'inputDefaults' => array('label' => false,'div' => false,'errorMessage'=>true),'novalidate'=>true));?>
	            <div class="form-group">
					<label for="exampleInputPassword1">Email</label> 
					<?php echo $this->Form->input('User.user_email',array('type'=>'text','id'=>'email_address','placeholder'=>"John.Smith@gmail.com",'class'=>"form-control {$error_class}",'tabindex'=>1, 'autofocus'=>true));?>
				</div>
				<div class="form-group">
					<label for="exampleInputPassword1">Password</label> 
					<?php echo $this->Form->input('User.password',array('type'=>'password','id'=>'password','placeholder'=>"Password",'class'=>"form-control {$error_class}",'tabindex'=>2));?>

					<div class="pull-left" style="width: 76%;">
					<?php echo $this->Form->checkbox('User.remember_me');?> Remember Me
					</div>
					
					<?php echo $this->Html->link('Forgot Password?',array('controller'=>'users','action'=>'forgot-password'),array('class'=>'pull-right forgot_password','tabindex'=>4));?>
				</div>
				<div class="clearfix">&nbsp;</div>
				<div class="col-xs-12  text-center">
					<?php echo $this->Form->button('Log In',array('class'=>'next-step-btn', 'type'=>'submit','tabindex'=>3));?>					
				</div>
				<div class="clearfix"></div>
				<div class="not_member text-center">
					Not a member? <span class="signup"> <?php echo $this->Html->link('Sign up.',array('controller'=>'users','action'=>'sign-up'),array('tabindex'=>5,'class'=>'signup'));?></span>
				</div>
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