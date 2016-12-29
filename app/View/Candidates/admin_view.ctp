<div class="modal-header">
    <?php
    //pr($company);
    echo $this->Form->button('&times;', array('class' => 'close closeModel', 'data-dismiss' => 'modal', 'aria-hidden' => true));
    echo '<strong>Candidate Details</strong>';
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
                                <strong><?php echo ucfirst($candidate['Candidate']['fname']);?></strong><br>
                                <table class="table table-user-information">
                                    <tbody>
                                    <tr>
                                        <td>First Name:</td>
                                        <td><?php echo ucfirst($candidate['Candidate']['fname']);?></td>
                                    </tr>
                                    <tr>
                                        <td>Last Name:</td>
                                        <td><?php echo ucfirst($candidate['Candidate']['lname']);?></td>
                                    </tr>
                                    <tr>
                                        <td>Email Id</td>
                                        <td><?php echo $candidate['Candidate']['email_id'];?></td>
                                    </tr>
                                    <tr>
                                        <td>Phone Number</td>
                                        <td><?php echo $candidate['Candidate']['phone'];?></td>
                                    </tr>
                                    <tr>
                                        <td>Created</td>
                                        <td><?php echo $candidate['Candidate']['created'];?></td>
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