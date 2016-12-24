<?php

/**
 * page to Show kicked off user(s) list 
 * @author Mystery Man
 */
echo $this->Paginator->options(array(
    'update' => '.panel-body',
    'evalScripts' => true
    ));
?>

<!-- start: PAGE HEADER -->
<div class="row">
    <div class="col-sm-12">
        <!-- start: PAGE TITLE & BREADCRUMB -->
        <ol class="breadcrumb">
            <li><i class="clip-file"></i>
                <?php echo $this->Html->link('Business Owners', array('controller' => 'businessOwners', 'action' => 'index', 'admin' => true));?>
            </li>
            <li class="active">Group change requests</li>
            <li class="search-box">
                <form class="sidebar-search">
                    <div class="form-group">
                        <input type="text" id="searching" name="search" placeholder="Start Searching...">
                    </div>
                <?php
                    $this->Js->get('#searching');
                    $this->Js->event('keyup',
                    $this->Js->request(array(
                            'controller'=>'businessOwners',
                            'action'=>'kickedOffUsers'),
                            array('async'=>true,
                                  'update'=>'.panel-body',
                                  'dataExpression'=>true,
                                    'data' => '$(\'#searching,#perpage\').serializeArray()',
                                  'method'=>'post')
                         )
                    );
                ?>

                </form>
            </li>
        </ol>
        <div class="page-header">
            <h1>
                Group change requests
                <?php echo $this->Element('records_per_page');?>
            </h1>
        </div>
        <?php
            $this->Js->get('#perpage');
            $this->Js->event('change',
            $this->Js->request(array(
                    'controller'=>'businessOwners',
                    'action'=>'kickedOffUsers'),
                    array('async'=>true,
                          'update'=>'.panel-body',
                          'dataExpression'=>true,
                          /*'data' => $this->Js->serializeForm(array(
                                        'isForm' => true,
                                        'inline' => true
                                    )),*/
                            'data' => '$(\'#searching,#perpage\').serializeArray()',
                          'method'=>'post')
                 )
            );
        ?>
        <!-- end: PAGE TITLE & BREADCRUMB -->
    </div>
</div>
<div class="row">
    
	<div class="col-md-12">
		<!-- start: BASIC TABLE PANEL -->
		<div class="panel panel-default">

            <div class="panel-body">
                <table id="sample-table-1" class="table table-hover">
                    <thead>
                        <tr>
                            <th class="center">S.No.</th>
                            <th><?php echo $this->Paginator->sort('fname','Member Name');?></th>                            
                            <th><?php echo $this->Paginator->sort('Group.group_type','Group Type');?></th>
                            <th><?php echo $this->Paginator->sort('Profession.profession_name','Member Profession');?></th>
                            <th><?php echo $this->Paginator->sort('ProfessionCategory.name','Profession Category');?></th>
                            <th><?php echo $this->Paginator->sort('Group.meeting_time','Meeting Time');?></th>
                            <th><?php echo $this->Paginator->sort('Group.id','Group Name');?></th>
                            <th style="text-align: center">Action</th>
                        </tr>
                    </thead>
                    <tbody id="professionContent">
                        <?php
                       
                        if (!empty($businessOwners)) {
                            foreach ($businessOwners as $businessOwner) {
                            	$businessOwnerId = $businessOwner['BusinessOwner']['id'];
                            	$groupChangeRequestID = $businessOwner['GroupChangeRequest']['id'];
                            	$meeting_time_current = $this->Functions->getZoneCurrentTime($businessOwner['Group']['timezone_id']);
                            	$meeting_time_grp = strtotime(date('Y-m-d H:i:s', strtotime($businessOwner['Group']['first_meeting_date'].' '.$businessOwner['Group']['meeting_time'])));
                            	$disableView = false;
                            	date('Y-m-d H:i:s', $meeting_time_current);
                            	date('Y-m-d H:i:s', $meeting_time_grp);
                            	$diff = round((($meeting_time_current-$meeting_time_grp)/3600), 1).'<br/>';
                            	if($diff >=-3 && $diff<=1.5) {
                            		$disableView = true;
                            	}
                                ?>
                        <tr>
                            <td class="center"><?php echo $counter;?></td>
                            <td class="hidden-xs"><?php echo ucfirst($businessOwner['BusinessOwner']['fname'])." ".$businessOwner['BusinessOwner']['lname']; ?></td>
                            <td><?php echo ucfirst($businessOwner['Group']['group_type']);?></td>
                            <td><?php echo ucfirst($businessOwner['Profession']['profession_name']);?></td> 
                            <td><?php echo ucfirst($businessOwner['ProfessionCategory']['name']);?></td> 
                            <td><?php echo date('h:i A',strtotime($businessOwner['Group']['meeting_time'])).' '.$businessOwner['Group']['timezone_id']; ?></td>
                            <td><?php echo 'Group '.$this->Encryption->decode($businessOwner['Group']['id']); ?></td>                            
                            <td class="center">
                                <div class="visible-md visible-lg hidden-sm hidden-xs">
                                <?php $params = array('class' => 'btn btn-xs btn-teal tooltips', 'data-original-title' => 'View', 'data-placement' => 'top', 'escape' => false);
                                if($disableView){$params['class'].=' disabled';}?>
                                    <?php echo $this->Html->link('<i class="clip-search"></i>', array('controller' => 'businessOwners', 'action' => 'userGroupChangeRequestsInfo', $groupChangeRequestID,'admin'=>true), $params); ?>
                                </div>
                            </td>
                        </tr>
                        <?php
                            $counter++;
                        }
                        }else{
                            echo "<tr><td colspan='7' style='text-align:center'>No records found</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
                <?php if($this->Paginator->numbers()){ ?>

                <div class="paging" style="float: right;">
                    <ul class="pagination" style="margin: 0px;">
                        <li>
              <?php echo $this->Paginator->prev(__('Previous',true)); ?>      
                        </li>
                        <li>
              <?php echo $this->Paginator->numbers(array('separator'=>false)); ?>      
                        </li>
                        <li>
             <?php echo $this->Paginator->next(__('Next',true)); ?>
                        </li>
                    </ul>
                </div>
                <?php } ?>
    <?php echo $this->Js->writeBuffer(); ?>
            </div>
        </div>
        <!-- end: BASIC TABLE PANEL -->
    </div>
</div>
