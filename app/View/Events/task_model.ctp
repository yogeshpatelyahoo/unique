<?php if(!empty($taskData)) {
    $script = "";
    $modalTitle = 'Update';
} else {
    $modalTitle = 'Create Task';
    $script = "$('.time-picker').val('');";
}

?>
<?php if(!empty($taskData)) { $url = array('controller'=>'events', 'action'=>'task-actions', 'edit');} else {$url =array('controller'=>'events', 'action'=>'task-actions', 'add');} ?>
<?php echo $this->Form->create('Task', array('url'=>$url, 'id'=>'EditTaskForm', 'class'=>"Choose-a-contact", 'novalidate'=>"novalidate"));?>
<div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
        <h4 class="modal-title" id="myModalLabel"><?php echo $modalTitle;?></h4>
      </div>
      
      <div class="modal-body">
       <div class="row">
             <div class="form-group col-md-12">
				<label for="exampleInputPassword1">Task Title <span class="star">*</span></label>
				<?php $title = (!empty($taskData))? $taskData['Task']['name']: '';?>
			<?php echo $this->Form->input('name', array('id'=>"company", 'placeholder'=>"Task Title", 'class'=>"form-control", 'label'=>false, 'value'=>$title));?>
			 </div>
             <div class="form-group col-md-6">
				<?php $task_date = (!empty($taskData))? $taskData['Task']['event_date']: '';?>
				<label for="task_date">Task Date <span class="star">*</span></label>
				<?php if(!empty($taskData)) {
				    $date_val = date('m-d-Y',strtotime($task_date));
				} else {$date_val ='';}?>
				<?php echo $this->Form->input('task_date', array('id'=>"task_date", 'placeholder'=>"MM-DD-YYYY", 'class'=>"form-control", 'data-date-format'=>"yyyy-mm-dd",'data-start-date'=>$todaydate, 'label'=>false, 'value'=>$date_val,'readonly' => 'readonly'));?>
				
				</div>
					
			<div class="form-group col-md-6">
			<label for="task_time">Task Time <span class="star">*</span></label>
			<?php if(!empty($taskData)) {
					    $time_val = date('H:i:a',strtotime($task_date));
					} else {$time_val ='';}?>
			<?php echo $this->Form->input('task_time', array('id'=>"task_time", 'placeholder'=>"HH:MM", 'class'=>"form-control time-picker", 'label'=>false, 'value'=>$time_val,'readonly' => 'readonly'));?>
			</div>
			
			<div class="form-group col-md-12">
			<label for="task_time">Note <span class="star">*</span></label>
			<?php if(!empty($taskData)) {
					    $description = $taskData['Task']['description'];
					} else {$description ='';}?>
			<?php echo $this->Form->textarea('description', array('id'=>"description", 'placeholder'=>"Task Description", 'class'=>"form-control", 'label'=>false, 'value'=>$description));?>
			</div>
			<div class="clearfix"></div>
			<?php if(!empty($taskData)) {echo $this->Form->hidden('task_id',array('value'=>$this->Encryption->decode($taskData['Task']['id'])));}?>
			
	</div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-sm file_sent_btn pull-right ML_btn " style="padding: 7px 30px 7px;font-size: 16px;" id="submit_btn" ><?php echo $modalTitle;?></button>
      </div>
<?php echo $this->Form->end();?>
    <div class="clearfix"></div>
	<script type="text/javascript">
        $(function () {
        	/*var date = new Date();
        	date.setDate(date.getDate());
        	var future = new Date();
        	future = LastDayOfMonth(future.getFullYear()+1, 12);
        	future.setDate(future.getDate());*/
            $('#task_date').datepicker({startDate: $('#task_date').data('start-date')/*, endDate: future*/, 'format':'mm-dd-yyyy'});
            $('#task_date').on('changeDate', function(ev){
                $(this).datepicker('hide');
            });
            $('.time-picker').timepicker({
            	showMeridian:true,
                minuteStep: 1,
                showInputs: true,
                disableFocus: true,
                defaultTime: '<?php echo $currentTime;?>'
            });

			$('.time-picker').timepicker().on('changeTime.timepicker', function(e) {
			//console.log('The time is ' + e.time.value);
			});



            <?php echo $script;?>
            $.validator.addMethod(
            	    "validateDate",
            	    function(value, element) {
            	    	return value.match(/^(0[1-9]|1[012])[- /.](0[1-9]|[12][0-9]|3[01])[- /.](19|20)\d\d$/);
            	    }
            	);
            /**
        	 * Validator for Task Form
        	 */
        	$("#EditTaskForm").validate({
                   ignore: [],
        	    rules: {	        
        	        
        	        'data[Task][name]':{	        	
                        required: true,
                        minlength: 5,
                        maxlength: 60,
        	        },
        	        'data[Task][description]':{	        	
                        required: true,
                        maxlength: 350,
                        
        	        },
        	        'data[Task][task_date]':{	        	
                        required: true,
                        validateDate: true,
        	        },
        	        'data[Task][task_time]':{
                        required: true,
                        remote: {
                            url: BASE_URL+"events/check-time",
                            type: "post",
                            data: {'task_date':function(){return $('#task_date').val()}},
                        }
        	        },
        	       
        	    },
        	    messages: {
        	    	'data[Task][name]':{	        	
                        required: 'This field is required',
                        'minlength': 'Title can have minimum 5 and maximum 60 characters',
                        'maxlength': 'Title can have minimum 5 and maximum 60 characters'
        	        },
        	        'data[Task][description]':{
        	        	required: 'This field is required',
        	        	'maxlength': 'Description can have maximum 350 characters'
            	        
            	     },
        	        'data[Task][task_date]':{	        	
                        required: 'This field is required',
                        'validateDate': 'Please enter valid date'
        	        },
        	        'data[Task][task_time]':{
                        required: 'This field is required',
                        remote: 'Invalid Time'
        	        }
        	    },
        	    submitHandler: function (form) {
        			$('#submit_btn').attr('disabled',true);
        	    	form.submit();
        	    }
        	});
        });
        function LastDayOfMonth(Year, Month) {
            return new Date( (new Date(Year, Month,1))-1 );
        }
        
    </script>
