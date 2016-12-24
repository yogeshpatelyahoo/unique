<?php 
/**
 * Contact us page
 * @author Laxmi Saini
 */
?>
<div class="inner_pages_heading">
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <div class="intro-text">
                    <span class="inner_page_name">Contact </span>
                </div>
            </div>

        </div>
    </div>
</div>
<?php echo $this->Session->flash(); ?>
<div class="clearfix"></div>

<section id="inner_pages_top_gap " class="contact_us_gap">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
               <?php  echo $this->Form->create('Page',array('url'=> array('controller' => 'pages', 'action' => 'contact-us'), 'class' => 'contact_form width50 width100', 'id' => 'userFeedback')); ?>
                    <div class="form-group ">
                        <?php echo $this->Form->input('name', array('label' => false, 'class' => 'form-control txt_login', 'type' => 'text', 'placeholder' => 'Name *'));?>
                    </div>
                    <div class="form-group">
                        <?php echo $this->Form->input('email', array('label' => false, 'class' => 'form-control txt_login', 'type' => 'text', 'placeholder' => 'E-mail *'));?>
                    </div>
                    <div class="form-group">
                        <?php echo $this->Form->input('company', array('label' => false, 'class' => 'form-control txt_login', 'type' => 'text', 'placeholder' => 'Company'));?>
                    </div>
                    <div class="form-group">
                        <?php echo $this->Form->input('phone', array('label' => false, 'class' => 'form-control txt_login', 'type' => 'text', 'placeholder' => 'Phone'));?>
                    </div>
                    <div class="form-group ">
                        <?php $options = array('1' => '1 - 50 employees', '2' => '51 - 100 employees', '3'=>'101 - 500 employees', '4'=>'501 - 1000 employees', '5'=>'1001+ employees');
                        echo $this->Form->select('employeesNumber', $options, array('escape' => false, 'label' => false, 'class' => 'form-control txt_login','empty' =>NULL));?>
                        
                    </div>
                    <div class="form-group">
                        <?php echo $this->Form->input('comment', array('label' => false, 'class' => 'form-control multi-textbox txt_login', 'type' => 'text','rows' => 4, 'placeholder' => 'Comment *'));?>
                    </div>
                    <div class="form-group">
                        <?php echo $this->Form->button('SUBMIT', array('type' => 'submit', 'class' => 'become_btn1 become_btn mail-btn')); ?>
                    </div>
                <?php echo $this->Form->end(); ?>

                <div class="clearfix"></div>
            </div>
            <div class="col-md-8"> <h2 class="contact_info text-dark">Contact us</h2></div>
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-6 col-sm-6">
                        <div class="support_div"><i class="fa fa-support support_icon"></i></div>
                        <div class="support_text">  Support</div>
                        <p class="support_ptext">Quick answers for all your problems</p>
                        <div class="clearfix"></div>
                        <div class="cont-icon">
                            <i class="fa fa-envelope-o"></i>&nbsp; support@foxhopr.com<br>
                            <i class="fa fa-envelope-o"></i> &nbsp; info@foxhopr.com
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <div class="clearfix"></div>
                        <div class="support_div">
                            <i class="fa fa-home support_icon"></i>
                        </div>
                        <div class="support_text">  Office</div>
                        <p class="support_ptext">
                            Foxhopr <br> PO Box 1859 New York, NY 10010<br>
                            <i style="font-size:16px ; color:#709cd2" class="fa fa-phone "></i>
                            &nbsp; <span class="office_contact">(212) 763-7721</span>
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-sm-6">
                        <div class="support_div">
                            <i class="fa fa-suitcase support_icon"></i>
                        </div>
                        <div class="support_text">  Careers</div>
                       <div class="contact-icon">
                            <i class="fa fa-envelope-o"></i>&nbsp;  careers@foxhopr.com
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <div class="support_div">
                            <i class="fa fa-comment support_icon"></i>
                        </div>
                        <div class="support_text">Press</div>
                        <div class="contact-icon">
                            <i class="fa fa-envelope-o"></i>&nbsp;  press@foxhopr.com
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="clearfix"></div>
<script type="text/javascript">
    $(document).ready(function(){
    	// Zip code check
    	$.validator.addMethod("alphaNumCheck", function (value, element) {
    	    var i = /^[A-Za-z0-9 \- . ]+$/;
    	    return this.optional(element) || (i.test(value) > 0);
    	}, "Only alphanumeric characters, space, period and hyphen are allowed.");
        $("#userFeedback").validate({
        onfocusout: false,
        rules: {
            'data[Page][name]': {
                required: true,
                maxlength: 40,
                alphaNumCheck: true
            },
            'data[Page][email]': {
                required: true,
                email: true,
            },
            'data[Page][company]': {
            	alphaNumCheck: true,
                maxlength:35
            },
            'data[Page][comment]': {
                required: true,
                maxlength: 350,
            },
            'data[Page][phone]': {
                number: true,
                maxlength:15
            },
            'data[Page][employeesNumber]': {
                number: true,
            },
           
        },
        messages: {
            'data[Page][name]': {
                required: "This field is required",
                maxlength: 'Maximum 40 characters are allowed'
            },
            'data[Page][email]': {
                required: "This field is required",
                email: "Please enter valid e-mail",
            },
            'data[Page][company]': {
                maxlength: 'Maximum 35 characters are allowed'
            },
            'data[Page][comment]': {
                required: "This field is required",
                maxlength: "Maximum 350 characters are allowed",
            },
            'data[Page][phone]': {
                number: 'Only numeric characters are allowed',
                maxlength: 'Maximum 15 characters are allowed'
            },
            'data[Page][employeesNumber]': {
                required: "This field is required",
            }
        },
        submitHandler: function (form) {
            form.submit();
        }
    });
    });
    </script>