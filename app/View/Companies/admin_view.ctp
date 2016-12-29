<div class="modal-header">
    <?php
    //pr($company);
    echo $this->Form->button('&times;', array('class' => 'close closeModel', 'data-dismiss' => 'modal', 'aria-hidden' => true));
    echo '<strong>Company Details</strong>';
    ?>
</div>
<div class="modal-body modal-dialog modal-lg">
   
<div class="row user-infos cyruxx">
            <div class="col-xs-12 col-sm-12 col-md-10 col-lg-12 col-xs-offset-0 col-sm-offset-0 ">
                <div class="panel panel-primary">
                   
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-3 col-lg-3 hidden-xs hidden-sm">
                                <img class="img-circle"
                                     src="https://lh5.googleusercontent.com/-b0-k99FZlyE/AAAAAAAAAAI/AAAAAAAAAAA/eu7opA4byxI/photo.jpg?sz=100"
                                     alt="User Pic">
                            </div>
                                                        
                            <div class=" col-md-9 col-lg-9 hidden-xs hidden-sm">
                                <strong><?php echo ucfirst($company['Company']['name']);?></strong><br>
                                <table class="table table-user-information">
                                    <tbody>
                                    <tr>
                                        <td>Name:</td>
                                        <td><?php echo $company['Company']['name'];?></td>
                                    </tr>
                                    <tr>
                                        <td>Email:</td>
                                        <td><?php echo $company['Company']['email_id'];?></td>
                                    </tr>
                                    <tr>
                                        <td>Phone</td>
                                        <td><?php echo $company['Company']['phone'];?></td>
                                    </tr>
                                    <tr>
                                        <td>Category</td>
                                        <td><?php echo $company['Category']['name'];?></td>
                                    </tr>
                                    <tr>
                                        <td>About</td>
                                        <td><?php echo $company['Company']['about']?></td>
                                    </tr>
                                    <tr>
                                        <td>Technologies</td>
                                        <td><?php $tech = unserialize($company['Company']['technologies']);
                           foreach ($tech as $badge) {?>
                           	<span class="badge"><?php echo $badge;?></span>&nbsp;
                           <?php }
                           ?></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <button class="btn btn-sm btn-primary" type="button"
                                data-toggle="tooltip"
                                data-original-title="Send message to user"><i class="glyphicon glyphicon-envelope"></i></button>
                        
                    </div>
                </div>
            </div>
        </div> 
</div>

<script>
    $(document).ready(function(){
        $('.closeModel').click(function(){
            $("a.view_suggestion").tooltip('disable');
        });
    });
</script>