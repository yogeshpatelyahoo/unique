<!-- start: PAGE HEADER -->
<style>.seperator{padding: 32px 0 0;text-align: center;width: 10px;} .paddTop{padding: 32px 0 0!important;}</style>
<?php echo $this->Html->script('../developer/js/admin_validation');
//    pr($membershipLevels);
?>
<div class="row">
    <div class="col-sm-12">
        <!-- start: PAGE TITLE & BREADCRUMB -->
        <ol class="breadcrumb">
            <li>
                <i class="clip-file"></i>
                <?php echo $this->Html->link('Business Owners', array('controller' => 'businessOwners', 'action' => 'index', 'admin' => true));?>
            </li>
            <li class="active">
                Email setup
            </li>
           
        </ol>
        <div class="page-header">
            <?php echo $this->Html->tag('h1', 'Email setup');?>
        </div>
        <!-- end: PAGE TITLE & BREADCRUMB -->
    </div>
</div>

<!-- end: PAGE HEADER -->
<div class="row">
    <div class="col-sm-12">
        <!-- start: FORM WIZARD PANEL -->
        <div class="panel panel-default">
            <div class="panel-body">
                <?php                
                if(!empty($emailMasterData)) {
                	echo $this->Form->create('EmailMasters', array('url' => array('controller' => 'emailSetups', 'action' => 'index', 'admin'=>true), 'class' => 'smart-wizard form-horizontal', 'id' => 'emailSetup'));
                	?>
                	<table id="sample-table-1" class="table table-hover">
                    <thead>
                        <tr>
                            <th class="center col-md-2">S.No.</th>
                            <th class="col-md-3">Triggered Event</th>
                            <th class="col-md-3">From Email ID</th>
                            <th class="col-md-3">From Name</th>
                            <th class="col-md-1"></th>
                        </tr>
                    </thead>
                    <tbody id="professionContent">
                    <?php $i=1;
                    foreach($emailMasterData as $row) {?> 
                      	<tr>
                            <td class="center"><?php echo $i;?></td>
                            <td class="hidden-xs"><?php echo ucwords($row['EmailMaster']['email_type_name']);?></td>
                            <td><input name="data[EmailMaster][<?php echo $i-1;?>][email_from]" class="form-control" readonly="readonly"  type="text" id="email_from_<?php echo $i;?>" value="<?php echo $row['EmailMaster']['email_from'];?>"></td>
                            <td><input name="data[EmailMaster][<?php echo $i-1;?>][from_name]" class="form-control" readonly="readonly" type="text" id="from_name_<?php echo $i;?>" value="<?php echo $row['EmailMaster']['from_name'];?>">
                            <input type="hidden" name="data[EmailMaster][<?php echo $i-1;?>][id]" value="<?php echo $row['EmailMaster']['id'];?>"/>
                            </td>                      
                            <td><a href="<?php echo Router::url(array('controller'=>'emailSetups', 'action'=>'sendTestMail', $row['EmailMaster']['id']));?>" ><i class="fa fa-paper-plane"></i></a></td>
                            
                        </tr>
                        <?php $i++;}?>

               </tbody>
                </table>
                <?php }?>
               <div class="form-group">
                        <div class="col-sm-1 col-sm-offset-10" style="padding-right: 6px;">                           
                            <?php echo $this->Form->button('Edit <i class="fa fa-arrow-circle-right"></i>', array('type'=>"button", 'class' => 'btn btn-bricky pull-right', 'id'=>'editButton')); ?>
                        </div>
                    </div>
                    <div class="form-group">
                    <div class="col-sm-2 col-sm-offset-10" id="editButtonDiv" style="display:none;">
                            <div class="input text">
                                <div class="col-md-4"><button type="submit" class="btn btn-bricky pull-right" data-style="slide-left" id="newsScheduleSubmit" style="margin-right:-15px;">Save <i class="fa fa-arrow-circle-right"></i></button></div>
                            
                               
	                        </div> 
                        </div>
                        </div>
                <?php echo $this->Form->end(); ?>
            </div>
        </div>
        <!-- end: FORM WIZARD PANEL -->
    </div>
</div>
<script>
$(document).ready(function(){
	$('#editButton').on('click', function() {
		$('#editButton').closest('.form-group').fadeOut('fast', function(){
			$('input[type="text"]').removeAttr('readonly');
			$('#editButtonDiv').fadeIn('fast');
		});
	});
});
</script>