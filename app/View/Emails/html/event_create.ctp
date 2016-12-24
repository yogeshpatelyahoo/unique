Hi,<br/><br/>

You have been invited by <?php echo $inviter_name;?> to a special online event.<br/><br/>
Title:<?php echo $title?><br/>
Description:<?php echo $description?> <br/>
Date:<?php echo $date;?><br/>
Time:<?php echo $time;?><br/>

<a href="<?php echo Router::url(array('controller'=>'events', 'action'=>'index'), true);?>">View Invitation</a><br/><br/>

Enjoy the event!

