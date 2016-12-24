<div class="modal-header">
        <?php
        echo $this->Form->button('&times;', array('class' => 'close closeModel', 'data-dismiss' => 'modal', 'aria-hidden' => true));
        echo $this->Html->tag('h4', 'Delete Confirmation', array('class' => 'Delete Confirmation'));
        ?>
    </div>
    <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                <?php
                echo $this->Html->tag('p', 'Are you sure you want to delete this Coupon?');
                ?>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <?php
        echo $this->Form->button('Cancel', array('data-dismiss' => 'modal', 'class' => 'btn btn-light-grey closeModel'));
        echo '&nbsp;';
        echo $this->Form->postLink('Confirm', array('action' => 'delete', $id), array('class' => 'btn  btn-bricky tooltips', 'data-placement' => 'top', 'escape' => false)
        );
        ?>
    </div>