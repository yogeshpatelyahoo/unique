<style>
    .noData{
        text-align:center;
    }
</style>
<?php $actionUrl = 'events/popup-function'; ?>
<?php $massActionUrl = 'events/mass-action-function'; ?>
<?php $this->Paginator->options(array('update' => '#ajaxTableContent', 'evalScripts' => true)); ?>

<form action="" id="massForm">
    <div class="row margin_top_referral_search">
        <div class="col-md-9 col-sm-9">
                
            <div class="clearfix">&nbsp;</div>
            <div class="row">
                <div class="col-md-7 col-sm-5 col-xs-5 width_at_mob">
                    <div id="imaginary_container">
                        <div class="input-group   ">
                            <input autocomplete="off" type="text" id="searching" name="search" placeholder="Search" class="search-query form-control innerpage_search clearable" value="<?php echo $search;?>"/>
                            <span class="input-group-btn">
                                <button type="button" class="btn inner_pagesbtn front_search">
                                    <span class=" glyphicon glyphicon-search"></span>
                                </button>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-md-5 col-sm-7 col-xs-7 width_at_mob">
                    <div class=" action_bulk">
                        <label class="labelSelect">
                            <select class="selectNew form-control seclect_value seclect_bulk" id="mass_action" name="mass_action">
                                <option value=""> More</option>
                                <option value="massdelete">Delete</option>
                            </select>
                        </label>
                    </div>
                    <div class="select_box pull-right">
                        <label class="labelSelect">
                        <?php echo $this->Form->input('perpage', array('id'=>'perpage','type'=>'select','options'=>Configure::read('PERPAGE'),'empty' => false,'name'=>'perpage','class'=>"selectNew form-control seclect_value",'label'=>false));?>
                        </label>
                    </div><div class="results_pages pull-right" >Results per page &nbsp;&nbsp;&nbsp;</div>
                    <?php
                        $this->Js->get('#perpage');
                        $this->Js->event('change', $this->Js->request(array(
                                            'controller'=>'events',
                                            'action'=>'tasks'
                                            ), array(
                                                'async'=>true,
                                                'update'=>'#ajaxTableContent',
                                                'dataExpression'=>true,
                                                'data' => '$(\'#searching,#perpage\').serializeArray()',
                                                'method'=>'post')
                                            )
                                        );
                        $this->Js->get('#searching');
                        $this->Js->event('keyup',$this->Js->request(array(
                                            'controller'=>'events',
                                            'action'=>'tasks'
                                            ), array(
                                                'async' => true,
                                                'update'=>'#ajaxTableContent',
                                                'dataExpression'=>true,
                                                'data' => '$(\'#searching,#perpage\').serializeArray()',
                                                'method'=>'post'
                                                )
                                            )
                                        );
                    ?>
                </div>
            </div>
        <div class="clearfix">&nbsp;</div>
            <div id="no-more-tables">
                <div id="ajaxTableContent">
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
                              $zoneCurrentTime = $this->Functions->getZoneCurrentTime($this->Session->read('Auth.Front.BusinessOwners.timezone_id'));
                              //$currentDateTime = $this->Functions->dateTime(Configure::read('CURRENT_DATE_TIME'),$this->Session->read('Auth.Front.BusinessOwners.timezone_id'));
                              if($zoneCurrentTime > strtotime($taskData['Task']['event_date'])) {
                                  $taskStatus = "Completed";
                              }                              
                              ?>
                              <tr>
                                <td>
                                  <span class="check_inpurt"><input name="taskIds[]" type="checkbox" class="checkthis" id="contact_<?php echo $taskData['Task']['id']?>" value="<?php echo $taskData['Task']['id']?>"></span>
                                </td>
                                <td class="">
                                    <?php echo htmlentities($taskData['Task']['name']); ?></td>
                                <td class="">
                                <?php 
                                echo  date('M d, Y @ h:i A',strtotime($taskData['Task']['event_date']));
                                //$eventDateTime = $data['Event']['event_date'].' '.$data['Event']['event_time'];
                        		//echo date("M d, Y h:i A", $this->Functions->dateTime($taskData['Task']['event_date'],$this->Session->read('Auth.Front.BusinessOwners.timezone_id')));
                                ?>
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
                              <tr><td colspan="6" class="noData"><?php echo isset ($noDataMsg) ? $noDataMsg : "No record found"; ?></td></tr>
                          <?php } ?>
                        </tbody>
                    </table>
                    <div class="clearfix">&nbsp;</div>
                    <?php if ($this->Paginator->numbers()) { ?>
                        <ul class="pagination pagination_table pagination-sm pull-right">
                            <li><?php echo $this->Paginator->prev("&#171", array('tag' => false)); ?></li>
                            <li><?php echo $this->Paginator->numbers(array('separator' => false)); ?> </li>
                            <li><?php echo $this->Paginator->next("&#187", array('tag' => false)); ?></li>
                        </ul>
                    <?php } ?>
                    <?php echo $this->Js->writeBuffer(); ?>
                </div>
            </div>
        </div>
        <?php echo $this->element("Front/loginSidebar",array('tabpage' => 'taskList'));?>
</div>
<?php echo $this->element('Front/bottom_ads');?>    
</form>
<form id="contactDetailPage" action="">
<?php echo $this->Form->hidden('saveurl',array('id'=>'saveurl_field_val','value'=>$this->Paginator->url()));
    echo $this->Form->hidden('search_val',array('id'=>'search_field_val','value'=>$search));
    echo $this->Html->script('Front/all');
?> 
</form>
<script>
var massActionURL = '<?php echo $massActionUrl; ?>';
var ajaxUrl = "<?php echo Router::url(array('controller'=>'events','action'=>'get-model-data'));?>";    
</script>
<?php echo $this->HTML->script('Front/events_tasks');?>
<style>.datepicker,#task_time,.bootstrap-timepicker-widget{z-index:11511 !important;}</style>