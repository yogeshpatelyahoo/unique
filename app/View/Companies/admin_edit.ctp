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
                <?php echo $this->Html->link('Company', array('controller' => 'companies', 'action' => 'index', 'admin' => true)); ?>
            </li>
            <li class="active"><?php echo __("Add Company");?></li>
        </ol>
        <div class="page-header">
            <?php echo $this->Html->tag('h1','Edit Company'); ?>
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
                <?php echo $this->Form->create('Company', array('url' => array('controller' => 'companies', 'action' => 'edit', 'admin' => true, $id), 'class' => 'smart-wizard form-horizontal', 'id' => 'addUsersForm', 'novalidate'=>'true', 'type' => 'file','inputDefaults' => array('errorMessage' => true))); ?>
                <?php echo $this->Form->hidden('Company.id');?>
                <div id="wizard" class="swMain">
                    

                    <div class="form-group">
                            <?php echo $this->Form->label('', 'Company Name'.$this->Html->tag('span', '', array('class' => 'symbol required')), array('class' => 'col-sm-3 control-label')); ?>
                        <div class="col-sm-7">
                            <?php echo $this->Form->input('Company.name', array('label' => false, 'class' => 'form-control', 'id' => 'fname', 'placeholder'=>'Company Name'));?>
                        </div>
                    </div>
                                        
                    <div class="form-group">
                            <?php echo $this->Form->label('', 'Email'.$this->Html->tag('span', '', array('class' => 'symbol required')), array('class' => 'col-sm-3 control-label')); ?>
                        <div class="col-sm-7">
                            <?php echo $this->Form->input('Company.email_id', array('label' => false, 'class' => 'form-control', 'id' => 'email_id', 'placeholder'=>'Email', 'type'=>'email'));?>
                        </div>
                    </div>
                     
					<div class="form-group">
                            <?php echo $this->Form->label('', 'Contact Number'.$this->Html->tag('span', '', array('class' => 'symbol required')), array('class' => 'col-sm-3 control-label')); ?>
                        <div class="col-sm-7">
                            <?php echo $this->Form->input('Company.phone', array('label' => false, 'class' => 'form-control', 'id' => 'phone', 'placeholder'=>'Contact Number'));?>
                        </div>
                    </div> 
                    
                    <div class="form-group">
                            <?php echo $this->Form->label('', 'Category'.$this->Html->tag('span', '', array('class' => 'symbol required')), array('class' => 'col-sm-3 control-label')); ?>
                        <div class="col-sm-7">
                       
                            <?php echo $this->Form->select('Company.category_id', $categories, array('label' => false, 'class' => 'form-control', 'id' => 'category_id','empty'=>false));?>
                        </div>
                    </div> 
                    
                    <div class="form-group">
                            <?php echo $this->Form->label('', 'Description'.$this->Html->tag('span', '', array('class' => 'symbol required')), array('class' => 'col-sm-3 control-label')); ?>
                        <div class="col-sm-7">
                            <?php echo $this->Form->textarea('Company.about', array('label' => false, 'class' => 'form-control', 'id' => 'comment', 'placeholder'=>'Comment'));?>
                        </div>
                    </div> 
                    
                    <div class="form-group">
                            <?php echo $this->Form->label('', 'Technologies'.$this->Html->tag('span', '', array('class' => 'symbol required')), array('class' => 'col-sm-3 control-label')); ?>
                        <div class="col-sm-7">
                        <?php echo $this->Form->input('Company.technologies', array('type'=>'text', 'label' => false, 'class' => 'form-control', 'id' => 'tech', 'placeholder'=>'Tech', 'data-role'=>"tagsinput", 'value'=>implode(',', unserialize($this->request->data['Company']['technologies']))));?>
                            
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