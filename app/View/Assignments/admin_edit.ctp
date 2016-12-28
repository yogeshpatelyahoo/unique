<?php

/**
 * Add Advertisement
 * @author Laxmi Saini
 */
?>
<!-- start: PAGE HEADER -->
<div class="row">
    <div class="col-sm-12">
        <!-- start: PAGE TITLE & BREADCRUMB -->
        <ol class="breadcrumb">
            <li>
                <i class="clip-file"></i>
                <?php echo $this->Html->link('Users', array('controller' => 'advertisements', 'action' => 'index', 'admin' => true)); ?>
            </li>
            <li class="active"><?php echo __("Add User");?></li>
        </ol>
        <div class="page-header">
            <?php echo $this->Html->tag('h1','Edit User'); ?>
        </div>
        <!-- end: PAGE TITLE & BREADCRUMB -->
    </div>
</div>
<!-- end: PAGE HEADER -->
<div class="row">
    <div class="col-sm-12">
        <div id="responseMessage"></div>
        <!-- start: FORM WIZARD PANEL -->
        <div class="panel panel-default">
            <div class="panel-body">
                <?php echo $this->Form->create('Candidate', array('url' => array('controller' => 'candidates', 'action' => 'edit', 'admin' => true, $id), 'class' => 'smart-wizard form-horizontal', 'id' => 'editCandidate', 'novalidate'=>'true', 'type' => 'file','inputDefaults' => array('errorMessage' => true))); ?>
                <?php echo $this->Form->hidden('Candidate.id');?>
                <div id="wizard" class="swMain">
                    

                   <div class="form-group">
                            <?php echo $this->Form->label('', 'First Name'.$this->Html->tag('span', '', array('class' => 'symbol required')), array('class' => 'col-sm-3 control-label')); ?>
                        <div class="col-sm-7">
                            <?php echo $this->Form->input('Candidate.fname', array('label' => false, 'class' => 'form-control', 'id' => 'fname', 'placeholder'=>'First Name'));?>
                        </div>
                    </div>
                    
                    <div class="form-group">
                            <?php echo $this->Form->label('', 'Last Name'.$this->Html->tag('span', '', array('class' => 'symbol required')), array('class' => 'col-sm-3 control-label')); ?>
                        <div class="col-sm-7">
                            <?php echo $this->Form->input('Candidate.lname', array('label' => false, 'class' => 'form-control', 'id' => 'lname', 'placeholder'=>'Last Name'));?>
                        </div>
                    </div>
                                        
                    <div class="form-group">
                            <?php echo $this->Form->label('', 'Email'.$this->Html->tag('span', '', array('class' => 'symbol required')), array('class' => 'col-sm-3 control-label')); ?>
                        <div class="col-sm-7">
                            <?php echo $this->Form->input('Candidate.email_id', array('label' => false, 'class' => 'form-control', 'id' => 'email_id', 'placeholder'=>'User Email', 'type'=>'email', 'disabled'=>true));?>
                        </div>
                    </div>
                     
					<div class="form-group">
                            <?php echo $this->Form->label('', 'Phone'.$this->Html->tag('span', '', array('class' => 'symbol required')), array('class' => 'col-sm-3 control-label')); ?>
                        <div class="col-sm-7">
                            <?php echo $this->Form->input('Candidate.phone', array('label' => false, 'class' => 'form-control', 'id' => 'phone', 'placeholder'=>'Phone Number'));?>
                        </div>
                    </div> 
                    
                    <div class="form-group">
                            <?php echo $this->Form->label('', 'Category'.$this->Html->tag('span', '', array('class' => 'symbol required')), array('class' => 'col-sm-3 control-label')); ?>
                        <div class="col-sm-7">
                       
                            <?php echo $this->Form->select('Candidate.category_id', $categories, array('label' => false, 'class' => 'form-control', 'id' => 'category_id','empty'=>false, 'selected'=>''));?>
                        </div>
                    </div> 
                    
                    <div class="form-group">
                            <?php echo $this->Form->label('', 'Comment'.$this->Html->tag('span', '', array('class' => 'symbol required')), array('class' => 'col-sm-3 control-label')); ?>
                        <div class="col-sm-7">
                            <?php echo $this->Form->textarea('Candidate.comment', array('label' => false, 'class' => 'form-control', 'id' => 'comment', 'placeholder'=>'Comment'));?>
                        </div>
                    </div>  
                    
                    <div class="form-group">
                        <?php echo $this->Form->label('', 'Upload a Resume' . $this->Html->tag('span', '', array('class' => 'symbol required', 'for' => 'resume')), array('class' => 'col-sm-3 control-label')); ?>
                        <div class="col-sm-7">                            
                            <div class="col-sm-13" id='csvDiv'>								
                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                    <div class="input-group">
                                        <div class="form-control uneditable-input">
                                            <i class="fa fa-file fileupload-exists"></i>
                                            <span class="fileupload-preview"></span>
                                        </div>
                                        <div class="input-group-btn">
                                            <div class="btn btn-light-grey btn-file">
                                                <span class=""><i class="fa fa-folder-open-o"></i> Select file</span>
                                                <!-- <input type="file" class="file-input" name="data[trainingvideos][video_name]" id="video_name"> -->
                                                <?php 
                                                echo $this->Form->input('resume_file', array('type' => 'file','id'=>'video_name','class'=>"file-input",'label' => false,'div'=>false,'required'=>false)); 
                                                ?>
                                            </div>

                                        </div>

                                    </div>
                                    <span class="help-block pull-right"><i class="fa fa-info-circle"></i> Only dox, docx formats of maximum 10 MB is allowed</span>
                                </div>
                            </div>
                            <label class="error" for='deshdash' style="display: none">Please select a valid video file</label>
                            <span class="error_msg" style="color: red"><?php echo $error = isset($errormsg) ? $errormsg : ""; ?></span>
                        </div>
                    </div>  
                    
                    <div class="form-group">
                            <?php echo $this->Form->label('', 'Current Resume in our Records'.$this->Html->tag('span', '', array('class' => 'symbol required')), array('class' => 'col-sm-3 control-label')); ?>
                        <div class="col-sm-7">
                        <?php $filename = substr($this->request->data['Candidate']['resume_file'], strpos($this->request->data['Candidate']['resume_file'], '_')+1);?>
                            <?php echo $this->Html->link($filename, array('controller' => 'candidates', 'action' => 'downloadResume', 'admin' => true, $this->request->data['Candidate']['id']), array('target'=>'_blank')); ?>
                        </div>
                    </div>           
                               
                    <div class="form-group">
                        <div class="col-sm-2 col-sm-offset-8">
                            <?php echo $this->Form->button('Save <i class="fa fa-arrow-circle-right"></i>', array('type' => 'submit', 'class' => 'btn btn-bricky ladda-button pull-right','data-style'=>'slide-left')); ?>
                        </div>
                    </div>
                </div>
                <?php echo $this->Form->end(); ?>
            </div>
        </div>
        <!-- end: FORM WIZARD PANEL -->
    </div>
</div>
<script type="text/javascript">
var ajaxUrl = "<?php echo Router::url(array('controller' => 'businessOwners', 'action' => 'getProfessionList'));?>";
var professionIdSelected = '';
</script>
<?php echo $this->HTML->script('advertisements_admin_add');?>