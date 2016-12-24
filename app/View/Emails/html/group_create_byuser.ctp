Dear <?php echo $name?>,<br/><br/>
You have successfully created a group <strong><?php echo $groupname?></strong> and become leader of this group.<br/><br/>
To learn and unlock Group Leader rights, please watch our mandatory training video <a href="<?php echo Router::url(array('controller'=>'businessOwners', 'action'=>'trainingVideo'), true);?>" >here</a>
<br/>
Below are your group details:<br/>
<br/><br/>
Group Name : <b><?php echo $groupname;?></b><br/>
Meeting Date : <b><?php echo $meetingdate;?></b><br/>
Meeting Time : <b><?php echo $meetingtime;?></b><br/><br>

<br/>
<br/>
Get started following these few easy steps:<br/><br/>

Download the mobile app on your iPhone, iPad or Android here: <a href="#" target="_blank">Android App</a>&nbsp;&nbsp;<a href="#" target="_blank">IOS App</a><br/><br/>

Start building your referral network with our custom CRM <a href="<?php echo Router::url( array('controller'=>'users','action'=>'login'), true);?>" target="_blank">here</a><br/><br/>

Customer Support can always be found here: <a href="<?php echo Router::url( array('controller'=>'pages','action'=>'contact-us'), true);?>" target="_blank">Contact Us</a><br/>
Thanks for joining, see you at the next meeting and start Foxhopping!
