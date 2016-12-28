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
            <li class="active"><?php echo __("Add Candidate");?></li>
        </ol>
        <div class="page-header">
            <?php echo $this->Html->tag('h1','Add Candidate'); ?>
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
                <?php echo $this->Form->create('Assignment', array('url' => array('controller' => 'assignments', 'action' => 'add', 'admin' => true), 'class' => 'smart-wizard form-horizontal', 'id' => 'addCandidateForm', 'novalidate'=>'true', 'type' => 'file','inputDefaults' => array('errorMessage' => true))); ?>
                <div id="wizard" class="swMain">
                    

                    <div class="form-group">
                            <?php echo $this->Form->label('', 'Company'.$this->Html->tag('span', '', array('class' => 'symbol required')), array('class' => 'col-sm-3 control-label')); ?>
                        <div class="col-sm-7">
                            <?php echo $this->Form->select('Assignment.company_id', $companies, array('label' => false, 'class' => 'form-control', 'id' => 'category_id','empty'=>false));?>
                        </div>
                    </div>
                   
                    <div class="form-group">
                            <?php echo $this->Form->label('', 'Category'.$this->Html->tag('span', '', array('class' => 'symbol required')), array('class' => 'col-sm-3 control-label')); ?>
                        <div class="col-sm-7">
                       
                            <?php echo $this->Form->select('Assignment.category_id', $categories, array('label' => false, 'class' => 'form-control', 'id' => 'category_id','empty'=>false));?>
                        </div>
                    </div> 
                    
                    <div class="form-group">
                            <?php echo $this->Form->label('', 'Comment'.$this->Html->tag('span', '', array('class' => 'symbol required')), array('class' => 'col-sm-3 control-label')); ?>
                        <div class="col-sm-7">
                            <?php echo $this->Form->select('Assignment.candidates', $candidates, array('label' => false, 'class' => 'form-control', 'id' => 'candidate_id','empty'=>false, 'multiple'=>true));?>
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