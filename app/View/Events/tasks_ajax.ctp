<?php $this->Paginator->options(array('update' => '#ajaxTableContent', 'evalScripts' => true)); ?>
<?php echo $this->Paginator->options(array('url' => array('action'=>'tasks',"perpage"=>$perpage,"search"=>$search,'sort'=> $this->Session->read('sort'),'direction'=> $this->Session->read('direction'))));
?>
<?php $actionUrl = 'events/popup-function'; ?>
<table class="col-md-12 table-bordered table-striped table-condensed no-more-tables cf data_table">
    <thead class="cf">
        <tr>
            <th width="1%"><input type="checkbox" id="checkall"></th>
            <th width="40%"><?php echo $this->Paginator->sort('Task.name', 'Title'); ?></th>
            <th width="25%"><?php echo $this->Paginator->sort('Task.event_date', 'Date and Time'); ?></th>
            <th width="17%">Status</th>
            <th width="17%"></th>
        </tr>
    </thead>
    <tbody>
     <?php if (isset($taskList) && !empty($taskList)) {
            foreach ($taskList as $taskData) {
              $taskId = $taskData['Task']['id'];
              $taskStatus = "Upcoming";
              if(strtotime(date('Y-m-d H:i:s'))>strtotime($taskData['Task']['event_date'])) {
                  $taskStatus = "Completed";
              }
              
              ?>
              <tr>
                <td>
                  <span class="check_inpurt"><input name="taskIds[]" type="checkbox" class="checkthis" id="contact_<?php echo $taskData['Task']['id']?>" value="<?php echo $taskData['Task']['id']?>"></span>
                </td>
                <td class="">
                    <?php echo htmlentities($taskData['Task']['name']); ?></td>
                <td class=""><?php echo  date('M d, Y h:i A',strtotime($taskData['Task']['event_date']));?>
                </td>
                <td class=""><?php echo $taskStatus;?></td>
                <td>
                    <a title="Edit" href="javascript:void(0);" class="<?php if($taskStatus=='Completed'){echo 'search_table_bg2';} else {echo 'search_table_bg';}?>" <?php if($taskStatus!='Completed'){?> data-toggle="modal" data-target="#taskModal" onclick="loadModel(<?php echo $this->Encryption->decode($taskData['Task']['id']);?>, 'edit');"<?php }?>>
                    <span class="glyphicon glyphicon-pencil table_search_icon "></span>
                    </a>
                   <a class="search_table_bg" href="javascript:void(0)" data-toggle="modal" data-target="#myModal" onclick="popUp('<?php echo $actionUrl;?>', '<?php echo $taskId; ?>','<?php echo 'events'; ?>', '<?php echo 'delete-task'; ?>', '<?php echo 'events/tasks'; ?>')" escape = false>
                      <span class="glyphicon glyphicon-trash table_search_icon" title="Delete"></span>
                    </a>
                    
                    <div class="clearfix"></div>
                </td>
              </tr>
          <?php }
          } else {
          ?>
            <tr><td colspan="5" class="noData"><?php echo isset ($noDataMsg) ? $noDataMsg : "No results found"; ?></td></tr>
        <?php } ?>
    </tbody>
</table>
<div class="clearfix">&nbsp;</div>
<?php if ($this->Paginator->numbers()) { ?>
    <ul class="pagination pagination_table pagination-sm pull-right">
        <li><?php echo $this->Paginator->prev('&#171', array('tag' => false)); ?></li>
        <li><?php echo $this->Paginator->numbers(array('separator' => false)); ?> </li>
        <li><?php echo $this->Paginator->next('&#187', array('tag' => false)); ?></li>
    </ul>
<?php } ?>
<?php echo $this->Js->writeBuffer(); ?>
<script>
var paginatorUrl = '<?php echo $this->Paginator->url()?>';
</script>
<?php echo $this->HTML->script('Front/events_tasks_ajax');?>