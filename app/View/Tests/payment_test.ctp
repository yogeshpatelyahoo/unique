<!DOCTYPE html>
<!--[if lt IE 7]> <html class="lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]> <html class="lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]> <html class="lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="en"> <!--<![endif]-->
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>Checkout Form</title>
  <?php echo $this->Html->css('style_authtest');?>
  <link rel="stylesheet" href="css/">
  <!--[if lt IE 9]><script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
</head>
<body>
<?php echo $this->Session->flash();?>
  <form class="checkout" action="" method="post">
    <div class="checkout-header">
      <h1 class="checkout-title">
        Checkout
        <span class="checkout-price">$10</span>
        <input type="hidden" name="x_amount" value="10">
      </h1>
    </div>
    
    <p>
      <input type="text" class="checkout-input checkout-name" placeholder="Your name" autofocus>
      <input type="text" class="checkout-input checkout-exp" name="exp_mnth" placeholder="MM">
      <input type="text" class="checkout-input checkout-exp" name="exp_yr" placeholder="YY">
    </p>
    <p>
      <input type="text" class="checkout-input checkout-card" name="x_card_num" placeholder="4111 1111 1111 1111">
      <input type="text" class="checkout-input checkout-cvc" placeholder="CVC">
    </p>
    <p>
      <input type="submit" value="Purchase" class="checkout-btn">
    </p>
  </form>

</body>
</html>