<?php $this->Paginator->options(array('update' => '.panel-body','evalScripts' => true)); ?>
<?php echo $this->Paginator->options(array('url' => array("perpage"=>$perpage,"search"=>$search,'sort'=> $this->Session->read('sort'),'direction'=> $this->Session->read('direction'))));
$deleteUrl = 'admin/categories/delete/';
?>
<table id="sample-table-1" class="table table-hover">
    <thead>
        <tr>
            <th class="center">S.No.</th>
            <th><?php echo $this->Paginator->sort('name', 'Category Name'); ?></th>
            <!-- <th><?php echo $this->Paginator->sort('created', 'Created On'); ?></th> -->
            <th style="text-align: center">Action</th>
        </tr>
    </thead>
    <tbody id="professionCategoryContent">
        <?php
        if (!empty($categoryList)) {
            foreach ($categoryList as $category) {
                $categoryId = $category['ProfessionCategory']['id'];
        ?>
                <tr>
                    <td class="center"><?php echo $counter;?></td>
                    <td class="hidden-xs"><?php echo htmlspecialchars(ucfirst($category['ProfessionCategory']['name'])); ?></td>
                    <!-- <td><?php echo date('Y-m-d', strtotime(str_replace('-','/', $category['ProfessionCategory']['created']))); ?></td> -->
                    <td class="center">
                        <div class="visible-md visible-lg hidden-sm hidden-xs">
                            <?php
                            echo $this->Html->link('<i class="fa fa-edit"></i>', array('controller' => 'categories', 'action' => 'admin_categoryEdit', $categoryId), array('class' => 'btn btn-xs btn-teal tooltips', 'data-original-title' => 'Edit', 'data-placement' => 'top', 'escape' => false));
                            echo '&nbsp;';
                            echo $this->Html->link('<i class="fa fa-times fa fa-white"></i>', 'javascript:void(0)',
                            		array(
                            				'class' => 'btn btn-xs btn-bricky tooltips delete',
                            				'data-original-title' => 'Delete',
                            				'data-toggle' => 'modal',
                            				'data-backdrop'=>'static',
                            				'data-placement' => 'top',
                            				'id'=>$categoryId,
                            				'onclick'=>"popUp('".$deleteUrl."','".$categoryId."')",'escape' => false
                            		));
                            ?>
                        </div>
         
                    </td>
                </tr>
                <?php
               $counter++;
            }
        } else {
            echo "<tr><td colspan='5' style='text-align:center'>No record found.</td></tr>";
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
