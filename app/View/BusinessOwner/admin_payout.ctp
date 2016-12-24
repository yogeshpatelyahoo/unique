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
            <li class="active">User List</li>
            <li class="search-box">
    <!--            <form class="sidebar-search">
                    <div class="form-group">
                        <input type="text" id="searching" name="search" placeholder="Start Searching...">
                    </div>
                    <?php
                        $this->Js->get('#searching');
                        $this->Js->event('keyup',
                        $this->Js->request(array(
                                    'controller'=>'businessOwners',
                                    'action'=>'payout'
                                ),
                                array(
                                    'async'=>true,
                                    'update'=>'.panel-body',
                                    'dataExpression'=>true,
                                    'data' => '$(\'#searching,#perpage\').serializeArray()',
                                    'method'=>'post'
                                    )
                            )
                        );
                    ?>
                </form>-->
            </li>
        </ol>
        <div class="page-header">
            <h1>Users List
                <?php echo $this->Element('records_per_page');?>       
            </h1>
        </div>
        <?php
            $this->Js->get('#perpage');
            $this->Js->event('change',
            $this->Js->request(array(
                            'controller'=>'businessOwners',
                            'action'=>'payout'
                            ),
                        array(
                            'async'=>true,
                            'update'=>'.panel-body',
                            'dataExpression'=>true,
                            'data' => '$(\'#searching,#perpage\').serializeArray()',
                            'method'=>'post'
                            )
                 )
            );
        ?>
        <!-- end: PAGE TITLE & BREADCRUMB -->
    </div>
</div>
<div class="row">
    <div class="col-md-12">
    	<div class="panel panel-default">
            <div class="panel-body-wallet" >
            Your available paypal balance : <?php echo $paypalBalanceAdmin; ?>
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
                            <th><?php echo $this->Paginator->sort('BusinessOwner.fname', 'Member Name'); ?></th>
                            <th><?php echo $this->Paginator->sort('Country.country_name', 'Paypal Country'); ?></th>
                            <th><?php echo $this->Paginator->sort('BusinessOwner.group_id', 'Group ID'); ?></th>
                            <th><?php echo $this->Paginator->sort('amount', 'Wallet Balance (USD)'); ?></th>
                        </tr>
                    </thead>
                    <tbody id="walletContent">
                        <?php
                        if (!empty($walletData)) {
                            foreach ($walletData as $data) {
                                $payoutId = $data['PaypalDetail']['id'];
                        ?>
                                <tr>
                                    <td class="center"><?php echo $counter;?></td>
                                    <td><?php echo ucfirst($data['BusinessOwner']['fname']) . ' ' . ucfirst($data['BusinessOwner']['lname']); ?></td>
                                    <td><?php echo $data['Country']['country_name'];?></td>
                                    <td><?php echo Configure::read('GROUP_PREFIX') . ' ' . $data['BusinessOwner']['group_id'];?></td>
                                    <td><?php echo $data['PaypalDetail']['amount'];?></td>
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
                <?php if ($this->Paginator->numbers()) { ?>
                    <div class="paging" style="float:right;">
                        <ul class="pagination" style="margin:0px;">
                            <li>
                              <?php echo $this->Paginator->prev(__('Previous',true)); ?>      
                          </li>
                          <li>
                              <?php echo $this->Paginator->numbers(array('separator'=>false)); ?>      
                          </li>
                          <li>
                             <?php echo $this->Paginator->next(__('Next',true)); ?>
                          </li>
                        </ul>
                    </div>
                <?php } ?>
                <?php echo $this->Js->writeBuffer(); ?>
            </div>
        </div>
        <?php if (!empty($walletData)){ ?>
            <div class="form-group" style="height: 50px;">
                <div class="col-sm-2 col-sm-offset-10">
                <?php 
                echo $this->Html->link($this->Form->button('Calculate Payout Amount', array('type' => 'button', 'class' => 'btn btn-bricky pull-right ladda-button','data-style'=>'slide-left','id'=>'laddabutton')),array('controller'=>'businessOwners','action'=>'saveAmountToTransfer','admin'=>true), array('escape'=>false));
                ?>
                </div>
            </div>
            <?php } ?>
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