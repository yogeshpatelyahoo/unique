Hi <?php echo $name?>,<br><br>
Congratulations!<br><br>
<?php echo $sender_name; ?> has sent you a new referral.<br><br>
Click here to view: <a href="<?php echo Router::url(array('controller'=>'referrals', 'action'=>'received'), true);?>" >View Referral</a><br><br>