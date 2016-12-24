<?php echo $this->Paginator->options(array(
    'url' => array(
        "perpage"=>$perpage,
        'sort'=> $this->Session->read('sort'),
        'direction'=> $this->Session->read('direction')
        ),
    'update' => '.panel-body',
    'evalScripts' => true
    ));
?>

<table id="sample-table-1" class="table table-hover">
    <thead>
        <tr>
            <th class="center">S.No.</th>
            <th><?php echo $this->Paginator->sort('BusinessOwner.fname', 'Member Name'); ?></th>
            <th><?php echo $this->Paginator->sort('Country.country_name', 'Paypal Country'); ?></th>
            <th><?php echo $this->Paginator->sort('BusinessOwner.group_id', 'Group ID'); ?></th>
            <th><?php echo $this->Paginator->sort('PaypalPayoutStatus.transaction_amt', 'Wallet Balance (USD)'); ?></th>
            <th><?php echo $this->Paginator->sort('PaypalPayoutStatus.transaction_fees', 'Transaction Fees'); ?></th>
            <th><?php echo $this->Paginator->sort('PaypalPayoutStatus.amount', 'Amount paid'); ?></th>
            <th><?php echo $this->Paginator->sort('PaypalPayoutStatus.created', 'Transaction Date'); ?></th>
            <th><?php echo $this->Paginator->sort('PaypalPayoutStatus.status', 'Status'); ?></th>
        </tr>
    </thead>
    <tbody id="walletContent">
        <?php
            if (!empty($payoutStatusData)) {
                foreach ($payoutStatusData as $data) {
                    $payoutId = $data['PaypalDetail']['id'];
                    ?>
                    <tr>
                        <td class="center"><?php echo $counter;?></td>
                        <td><?php echo ucfirst($data['BusinessOwner']['fname']) . ' ' . ucfirst($data['BusinessOwner']['lname']); ?></td>
                        <td><?php echo $data['Country']['country_name'];?></td>
                        <td><?php echo Configure::read('GROUP_PREFIX') . ' ' . $data['PaypalPayoutStatus']['group_id'];?></td>
                        <td><?php echo $data['PaypalPayoutStatus']['amount'];?></td>
                        <td><?php echo $data['PaypalPayoutStatus']['transaction_fees'];?></td>
                        <td><?php echo $data['PaypalPayoutStatus']['transaction_amt'];?></td>
                        <td><?php echo date('m-d-Y', strtotime($data['PaypalPayoutStatus']['created']));?></td>
                        <td><?php echo ucfirst($data['PaypalPayoutStatus']['status']);?></td>
                    </tr>
                    <?php
                    $counter++;
                }
            } else {
                echo "<tr><td colspan='9' style='text-align:center'>No record found</td></tr>";
            }
        ?>
    </tbody>
</table>
<?php if($this->Paginator->numbers()){?>

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
<?php } echo $this->Js->writeBuffer();