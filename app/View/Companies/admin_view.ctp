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
                        <label for="" class="col-sm-3 control-label col-sm-offset-1">Name </label>                            <div class="col-sm-7">
                           <label for="" class="col-sm-12 control-label text_left col-sm-offset-1"><?php echo $company['Company']['name'];?></label>   
                            </div>
                        </div>

                        <div class="form-group">
                        <label for="" class="col-sm-3 control-label col-sm-offset-1">Email </label>                            <div class="col-sm-7">
                           <label for="" class="col-sm-12 control-label text_left col-sm-offset-1"><?php echo $company['Company']['email_id'];?></label>   
                            </div>
                        </div>

                        <div class="form-group">
                        <label for="" class="col-sm-3 control-label col-sm-offset-1">Phone </label>                            <div class="col-sm-7">
                           <label for="" class="col-sm-12 control-label text_left col-sm-offset-1"><?php echo $company['Company']['phone'];?></label>   
                            </div>
                        </div>

                        <div class="form-group">
                        <label for="" class="col-sm-3 control-label col-sm-offset-1">Category</label>                            <div class="col-sm-7">
                           <label for="" class="col-sm-12 control-label text_left col-sm-offset-1"><?php echo $company['Category']['name'];?></label>   
                            </div>
                        </div>

                        <div class="form-group">
                        <label for="" class="col-sm-3 control-label col-sm-offset-1">About</label>                            <div class="col-sm-7">
                           <label for="" class="col-sm-12 control-label text_left col-sm-offset-1"><?php echo $company['Company']['about']?></label>   
                            </div>
                        </div>
                        
                        <div class="form-group">
                        <label for="" class="col-sm-3 control-label col-sm-offset-1">Technologies</label>                            <div class="col-sm-7">
                           <label for="" class="col-sm-12 control-label text_left col-sm-offset-1"><?php 
                                              
                           $tech = unserialize($company['Company']['technologies']);
                           foreach ($tech as $badge) {?>
                           	<span class="badge"><?php echo $badge;?></span>&nbsp;
                           <?php }
                           ?></label>   
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