<?php
//adding Page specific css and javascript files
echo $this->Paginator->options(array(
    'url' => array(
        "perpage"=>$perpage,
        "search"=>$search,
        'sort'=> $this->Session->read('sort'),
        'direction'=> $this->Session->read('direction')        
        ),
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
            <li class="active">Group Change Requests</li>
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
                            'action'=>'groupChangeRequest'),
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
            <h1>Group Change Requests
                <?php echo $this->Element('records_per_page');?>
            </h1>
        </div>
        <?php
            $this->Js->get('#perpage');
            $this->Js->event('change',
            $this->Js->request(array(
                    'controller'=>'businessOwners',
                    'action'=>'groupChangeRequest'),
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
                            <th><?php echo $this->Paginator->sort('BusinessOwner.fname', 'Member Name'); ?></th>
                            <th><?php echo $this->Paginator->sort('Profession.profession_name', 'Profession'); ?></th> 
                            <th><?php echo $this->Paginator->sort('Group.id','Group Name');?></th>
                            <th><?php echo $this->Paginator->sort('Group.group_type','Group Type');?></th>                         
                            <th><?php echo $this->Paginator->sort('Group.meeting_time','Meeting Time');?></th>
                            <th style="text-align: center">Action</th>
                        </tr>
                    </thead>
                    <tbody id="professionContent">
                        <?php                    
                        if (!empty($businessOwners)) {
                            foreach ($businessOwners as $businessOwner) {
                                $businessOwnerId = $businessOwner['GroupChangeRequest']['id'];                                                             
                        ?>
                        <tr>
                            <td class="center"><?php echo $counter;?></td>
                            <td class="hidden-xs"><?php echo ucfirst($businessOwner['BusinessOwner']['fname']." ".$businessOwner['BusinessOwner']['lname']); ?></td>
                            <td><?php echo ucfirst($businessOwner['Profession']['profession_name']);?></td>
                            <td><?php echo Configure::read('GROUP_PREFIX').' '.$this->Encryption->decode($businessOwner['Group']['id']);?></td>
                            <td><?php echo ucfirst($businessOwner['Group']['group_type']);?></td>
                            <td><?php echo date('h:i A',strtotime($businessOwner['Group']['meeting_time'])).' EST';?></td>
                            <td class="center">
                                <div class="visible-md visible-lg hidden-sm hidden-xs">
                                    <?php
	                                    echo $this->Html->link('<i class="clip-search"></i>', array('controller' => 'businessOwners', 'action' => 'viewGroupChangeRequest', $businessOwnerId,'admin'=>true), array('class' => 'btn btn-xs btn-teal tooltips', 'data-original-title' => 'View', 'data-placement' => 'top', 'escape' => false));
	                                   ?>
                                </div>
                            </td>
                        </tr>
                        <?php
                                $counter++;
                            }
                        }else{
                            echo "<tr><td colspan='7' style='text-align:center'>No record found</td></tr>";
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
