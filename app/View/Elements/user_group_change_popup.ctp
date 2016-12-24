<div class="modal-header">
       <?php
       if(isset($popupData) && is_array($popupData)) {
       	extract($popupData);
       }
       echo $this->Form->button('&times;', array('class' => 'close closeModel', 'data-dismiss' => 'modal', 'aria-hidden' => true));
       echo $this->Html->tag('h4', $headerMsg, array('class' => 'Activate Confirmation'));
       
        
        ?>
    </div>
    <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                <?php
                echo $this->Html->tag('p', $actionMessage);
                ?>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <?php
        echo $this->Form->create('BusinessOwner', array('url' => array('controller' => 'businessOwners', 'action' => 'userGroupChangeRequest', 'admin' => true), 'class' => 'smart-wizard form-horizontal'));
        echo $this->Form->hidden('groupId', array('value'=>$groupId, 'class' => 'Activate Confirmation'));
        echo $this->Form->hidden('userId', array('value'=>$userId, 'class' => 'Activate Confirmation'));
        echo $this->Form->hidden('requestId', array('value'=>$requestId, 'class' => 'Activate Confirmation'));
        
        echo $this->Form->button($firstButtonLabel, array('data-dismiss' => 'modal', 'class' => 'btn btn-light-grey closeModel'));
        echo $this->Form->button('OK', array('class' => 'btn  btn-bricky tooltips popup_btn', 'data-placement' => 'top', 'escape' => false,'style'=>$secondButtonDisplay));
        echo $this->Form->end();
        ?>

    </div>
<script>
    $(document).ready(function(){
        $('.closeModel').click(function(){
          $(".delete").tooltip('disable');
          $(".activeInactive").tooltip('disable');
      });
    });
</script>
    