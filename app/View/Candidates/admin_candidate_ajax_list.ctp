<?php $this->Paginator->options(array('update' => '.panel-body','evalScripts' => true)); ?>
<?php echo $this->Paginator->options(array('url' => array("perpage"=>$perpage,"search"=>$search,'sort'=> $this->Session->read('sort'),'direction'=> $this->Session->read('direction'))));
$deleteUrl = 'admin/candidates/delete/';
?>
    <table id="sample-table-1" class="table table-hover">
                    <thead>
                        <tr>
                            <th class="center">S.No.</th>
            <th><?php echo $this->Paginator->sort('fname', 'Full Name'); ?></th>
            <th><?php echo $this->Paginator->sort('email_id', 'Email Id'); ?></th>
            <th><?php echo $this->Paginator->sort('phone', 'Phone'); ?></th>
            <th style="text-align: center">Action</th>
                        </tr>
                    </thead>
                    <tbody id="professionCategoryContent">
                        <?php
                        
                        if (!empty($candidates)) {
                            foreach ($candidates as $candidate) {
                            	$candidateId = $candidate['Candidate']['id'];
                        ?>
                                <tr>
                    <td class="center"><?php echo $counter;?></td>
                    <td class="hidden-xs"><?php echo htmlspecialchars(ucwords($candidate['Candidate']['fname'].' '.$candidate['Candidate']['lname'])); ?></td>
                    <td><?php echo $candidate['Candidate']['email_id'];?></td>
                    <td><?php echo $candidate['Candidate']['phone']; ?></td>
                    
                    <td class="center">
                        <div class="visible-md visible-lg hidden-sm hidden-xs">
                            <?php
                            echo $this->Html->link('<i class="clip-search"></i>', 'javascript:void(0)',
                            		array(
                            				'class' => 'btn btn-xs btn-teal tooltips view_suggestion',
                            
                            				'onclick'=>"popUp('admin/candidates/view','".$candidateId."')",'escape' => false
                            		));
                            echo '&nbsp;';
                            echo $this->Html->link('<i class="fa fa-edit"></i>', array('controller' => 'candidates', 'action' => 'admin_edit', $candidateId), array('class' => 'btn btn-xs btn-teal tooltips', 'data-original-title' => 'Edit', 'data-placement' => 'top', 'escape' => false));
                            echo '&nbsp;';
                            echo $this->Html->link('<i class="fa fa-times fa fa-white"></i>', 'javascript:void(0)',
                            		array(
                            				'class' => 'btn btn-xs btn-bricky tooltips delete',
                            				'data-original-title' => 'Delete',
                            				'data-toggle' => 'modal',
                            				'data-backdrop'=>'static',
                            				'data-placement' => 'top',
                            				'id'=>$candidate['Candidate']['id'],
                            				'onclick'=>"popUp('".$deleteUrl."','".$candidate['Candidate']['id']."')",'escape' => false
                            		));
                            ?>
                        </div>
         
                    </td>
                </tr>
                                <?php
                                $counter++;
                            }
                        } else {
                            echo "<tr><td colspan='5' style='text-align:center'>No record found</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
<?php 
    if($this->Paginator->numbers()){ ?>
<div class="paging" style="float:right;">
    <ul class="pagination" style="margin:0px;">
        <li><?php echo $this->Paginator->prev(__('Previous',true)); ?></li>
        <li><?php echo $this->Paginator->numbers(array('separator'=>false)); ?></li>
        <li><?php echo $this->Paginator->next(__('Next',true)); ?></li>
    </ul>
</div>
<?php }
echo $this->Js->writeBuffer();
