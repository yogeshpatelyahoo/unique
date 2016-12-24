<?php

/**
 * page to Show User group change Request(s) list 
 * @author Mystery Man
 */
echo $this->Paginator->options(array(
    'update' => '.panel-body',
    'evalScripts' => true
    ));
?>
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
                <?php echo $this->Js->writeBuffer(); ?>