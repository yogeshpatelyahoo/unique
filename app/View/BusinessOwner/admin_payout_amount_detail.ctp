<?php 
   $this->Paginator->options(array(
      'update' => '.panel-body',
      'evalScripts' => true
   )); 
?>
<!-- start: PAGE HEADER -->
<div class="row">
    <div class="col-sm-12">
        <!-- start: PAGE TITLE & BREADCRUMB -->
        <ol class="breadcrumb">
            <li>
                <i class="clip-file"></i>
                <?php echo $this->Html->link('Business Owners', array('controller' => 'businessOwners', 'action' => 'index', 'admin' => true));?>
            </li>
            <li class="active">Users List</li>
        </ol>
        <!--<div class="page-header">
            <h1>Users List
                <?php echo $this->Element('records_per_page');?>       
            </h1>
        </div>-->
    </div>
</div>
<div class="row" style="padding-top: 15px">
    <div class="col-md-12">
    	<div class="panel panel-default">
    		<div class="row">
    			<div class="col-md-6">
    				<div class="panel-body-wallet" >Your Available Paypal Balance : <?php echo $paypalBalanceAdmin; ?></div>
    			</div>
    			<div class="col-md-6">
    				<div class="panel-body-wallet" >Total Payout Amount is : <?php echo $walletTotalAmount[0]['PaypalPayoutStatus']['totalamount'] . ' USD'; ?></div>
    			</div>
    		</div>
    	</div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <!-- start: BASIC TABLE PANEL -->
        <div class="panel panel-default">
            <div class="panel-body" >
                <table id="sample-table-1" class="table table-hover">
                    <thead>
                        <tr>
                            <th class="center">S.No.</th>
                            <th>Member Name</th>
                            <th>Paypal Country</th>
                            <th>Group ID</th>
                            <th>Wallet Balance (USD)</th>
                            <th>Transaction Fees</th>
                            <th>Total Amount</th>
                        </tr>
                    </thead>
                    <tbody id="walletContent">
                        <?php
                        if (!empty($walletData)) {
                            $counter = 1;
                            foreach ($walletData as $data) {
                                $payoutId = $data['PaypalPayoutStatus']['id'];
                        ?>
                                <tr>
                                    <td class="center"><?php echo $counter;?></td>
                                    <td><?php echo $data['BusinessOwner']['fname'].' '.$data['BusinessOwner']['lname']; ?></td>
                                    <td><?php echo $data['Country']['country_name'];?></td>
                                    <td><?php echo Configure::read('GROUP_PREFIX') . ' ' . $data['PaypalPayoutStatus']['group_id'];?></td>
                                    <td><?php echo $data['PaypalPayoutStatus']['transaction_amt'] + $data['PaypalPayoutStatus']['transaction_fees'];?></td>
                                    <td><?php echo $data['PaypalPayoutStatus']['transaction_fees'];?></td>
                                    <td><?php echo $data['PaypalPayoutStatus']['transaction_amt'];?></td>
                                </tr>
                                <?php
                                $counter++;
                            }
                        } else {
                            echo "<tr><td colspan='5' style='text-align:center'>No record found</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
                <?php echo $this->Js->writeBuffer(); ?>
            </div>
        </div>
        <div class="form-group" style="height: 50px;">
                <div class="col-sm-2 col-sm-offset-10">
                <?php 
                if($disableWalletButton){
                	echo $this->Html->link($this->Form->button('Make Payment', array('type' => 'button', 'class' => 'btn btn-light-grey pull-right')),'javascript:void(0)', array('escape'=>false));
                } else {
                	echo $this->Html->link($this->Form->button('Make Payment', array('type' => 'button', 'class' => 'btn btn-bricky pull-right ladda-button','data-style'=>'slide-left','id'=>'laddabutton')),array('controller'=>'businessOwners','action'=>'payoutToUser','admin'=>true), array('escape'=>false));
              	}
                ?>
                </div>
            </div>
        <!-- end: BASIC TABLE PANEL -->
    </div>
</div>
<script>
	$(document).ready(function() {
    $("#laddabutton").click(function(){
        var l = Ladda.create(this);
	 	l.start();
    }); 
});
</script>