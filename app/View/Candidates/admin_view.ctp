<div class="modal-header">
    <?php
    //pr($company);
    echo $this->Form->button('&times;', array('class' => 'close closeModel', 'data-dismiss' => 'modal', 'aria-hidden' => true));
    echo '<strong>Company Details</strong>';
    ?>
</div>
<div class="modal-body modal-dialog modal-lg">
    <div class="row">
        <div class="col-md-12">
          <div class="panel panel-default">

            <div class="panel-body">
                <div class="smart-wizard form-horizontal">
                    <div id="wizard" class="swMain">
                        <div class="form-group">
                        <label for="" class="col-sm-3 control-label col-sm-offset-1">First Name </label>                            <div class="col-sm-7">
                           <label for="" class="col-sm-12 control-label text_left col-sm-offset-1"><?php echo $candidate['Candidate']['fname'];?></label>   
                            </div>
                        </div>

                        <div class="form-group">
                        <label for="" class="col-sm-3 control-label col-sm-offset-1">Last Name </label>                            <div class="col-sm-7">
                           <label for="" class="col-sm-12 control-label text_left col-sm-offset-1"><?php echo $candidate['Candidate']['lname'];?></label>   
                            </div>
                        </div>

                        <div class="form-group">
                        <label for="" class="col-sm-3 control-label col-sm-offset-1">Email Id </label>                            <div class="col-sm-7">
                           <label for="" class="col-sm-12 control-label text_left col-sm-offset-1"><?php echo $candidate['Candidate']['email_id'];?></label>   
                            </div>
                        </div>

                        <div class="form-group">
                        <label for="" class="col-sm-3 control-label col-sm-offset-1">Phone Number</label>                            <div class="col-sm-7">
                           <label for="" class="col-sm-12 control-label text_left col-sm-offset-1"><?php echo $candidate['Candidate']['phone'];?></label>   
                            </div>
                        </div>

                        <div class="form-group">
                        <label for="" class="col-sm-3 control-label col-sm-offset-1">Created</label>                            <div class="col-sm-7">
                           <label for="" class="col-sm-12 control-label text_left col-sm-offset-1"><?php echo $candidate['Candidate']['created'];?></label>   
                            </div>
                        </div>
                        
                        
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>
<div class="modal-footer">
</div>
<script>
    $(document).ready(function(){
        $('.closeModel').click(function(){
            $("a.view_suggestion").tooltip('disable');
        });
    });
</script>