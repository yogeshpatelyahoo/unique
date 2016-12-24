Hi <?php echo $username?>,<br/><br/>
You have a new message from <?php echo $writtenByName;?><br/><br/>
Subject: <b><?php echo $subject;?></b><br/>
Message: <b><?php echo $content;?></b><br/>
<br/>
Click here to view: <a href="<?php echo Router::url(array('controller'=>'messages', 'action'=>'inbox','admin'=>false), true);?>">View Message</a>