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
            echo $this->Form->button($firstButtonLabel, array('data-dismiss' => 'modal', 'class' => 'btn btn-light-grey closeModel'));
            echo '&nbsp;';
            if($action!='moveGroupMembers'){
                echo $this->Form->postLink('Confirm', $action.'/'.$id, array('class' => 'btn  btn-bricky tooltips popup_btn', 'data-placement' => 'top', 'escape' => false,'style'=>$secondButtonDisplay));
            }else {
                echo $this->Html->link($this->Form->button('Proceed', array('type' => 'button', 'class' => 'btn  btn-bricky tooltips popup_btn')), array('controller' => 'groups', 'action' => $action, 'admin' => true,$id), array('escape' => false)); 
            }
        
        
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
    