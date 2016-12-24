<!DOCTYPE html>
<html>
    <head>

        <title>Login with PayPal</title>
 
    </head>
    <body>
     
    </body>
    <script>
	
	window.opener.location.href ="<?php echo Router::url(array('controller'=>'businessOwners', 'action'=>'billing'), true);?>";
	window.close();
</script>
</html>