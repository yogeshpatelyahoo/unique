<?php
$amountPaid = $txData['Transaction']['amount_paid'];
$logoUrl = $this->webroot.'img/logo_black.png';
$discounts = 49.99 - $amountPaid;
$discounts = number_format((float)$discounts, 2, '.', '');
$state = $txData['State']['state_subdivision_name'];
$zipCode = $txData['Transaction']['bil_zipcode'];
$country = $txData['Country']['country_name'];
$city = $txData['Transaction']['bil_city'];
?>
                <!DOCTYPE html>
                <html lang="en">
                <head>
                <meta charset="utf-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <meta name="description" content="">
                <meta name="author" content="">
                <title>Unique</title>
                <!--[if lt IE 9]>
                <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
                <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
                <![endif]-->
                </head>
                <body id="page-top" class="index">

                <style>
                .table-responsive { min-height: 0.01%;overflow-x: auto;}
                table.table > tbody > tr > td, .table > tbody > tr > th, table.table > tfoot > tr > td, table.table > tfoot > tr > th, table.table > thead > tr > td, table.table > thead > tr > th {border: 0.1mm solid #ddd;line-height: 1.42857;padding: 8px;vertical-align: top; text-align:left;font-family: "Times New Roman", Times, serif; }
                .items tbody,.items thead { border-top: 0.1mm solid #000000;}td { vertical-align: top; } .items td {border-top: 0.1mm solid #ddd;} table thead td { text-align: center;font-variant: small-caps; }
                .items td.totals { text-align: right; border: 0.1mm solid #000000; } .items td.cost { text-align: "." center; }
                </style>

                <htmlpageheader name="myheader"> </htmlpageheader>

                <htmlpagefooter name="myfooter">

                <div style="border-top: 1px solid #000000; font-size: 9pt; text-align: center; padding-top: 3mm; ">
                Page {PAGENO} of {nb}
                </div>
                </htmlpagefooter>

                <sethtmlpageheader name="myheader" value="on" show-this-page="1" />
                <sethtmlpagefooter name="myfooter" value="on" />

                mpdf-->
                <table class="table items">
                <tr>
                <th scope="row" style="border-top:0"><a href="<?php echo Router::url('/');?>"><img src="<?php echo $logoUrl;?>" style="float:left;display:inline-block;text-align:left;width:30%;"></a></th>
         
                </tr>
                </table>
                <table class="table table-bordered items" width="100%" style="width:700px; margin:0 auto;font-size: 13pt; border-collapse: collapse; ">
                <thead>
                <tr>
                <th style=" border-top:0"></th>
                <td  style=" border-top:0"></td>

                <th  style=" text-align:right; border-top:0;padding-bottom:10px;padding-right:5px;">Receipt</th>
                </tr>


                </thead>
                <tbody>
                <tr >
       
                <td style="padding-top:30px;padding-left:5px;"><strong>Billed to:</strong></td>
                <td style="padding-top:30px;"></td>
                <td style="text-align:right;padding-top:30px;line-height:25px;padding-right:5px;"><strong>Receipt Date:</strong> <?php echo date('M d, Y', $this->Functions->dateTime($txData['Transaction']['created'],$this->Session->read('Auth.Front.BusinessOwners.timezone_id')));
                
                
                ?><br>
                </td>
                </tr>
                <tr style="border:none;">
         
                <td style="padding-top:2px;"></td>
                <td style="padding-top:2px;"></td>
                <td style="padding-top:2px;"></td>
                </tr>

                <tr style="border:none;">
                <td class="bt" style="padding-left:5px;"><?php echo $txData['BusinessOwner']['email'].'<br>'.$txData['BusinessOwner']['fname'].' '.$txData['BusinessOwner']['lname'].'<br>';?>
				<?php if (!empty($txData['Transaction']['bil_address'])) {
					echo ucfirst($txData['Transaction']['bil_address']);
				}
				if( $txData['Transaction']['bil_address']!='' && $city!=''){
					echo ', ';
				}
				if (!empty($city)) {
					echo ucfirst($city);
				}
				?>
                </td>
                <td class="bt"></td>
                <td class="bt"></td>

                </tr>

                <tr style="border:none;border-bottom:1px solid #ddd;">
                <td class="bt" style="padding-bottom:10px;padding-left:5px;"><?php echo $state.' '.$zipCode.'<br>'.$country;?></td>
                <td class="bt"></td>
                <td class="bt"></td>
<td class="bt"></td>
                </tr>
                <tr>
                <th style="text-align:left;padding-bottom:20px;padding-left:5px;width:40%;">Membership Plan</th>
                <th style="text-align:left;padding-bottom:20px;width:20%;">Discount</th>
                <th style="text-align:right;padding-bottom:20px;width:40%;padding-right:5px;">Price</th>
                	
                </tr>


                <tr>
                <td style="padding-bottom:40px;padding-left:5px;padding-left:5px;padding-right:5px;"><?php echo ucfirst($txData['Transaction']['group_type']);?></td>
                <td style="padding-bottom:40px;padding-right:5px;">$<?php echo $discounts;?></td>
                <td style="text-align:right;padding-bottom:40px;padding-right:5px;">$49.99</td>

                </tr>

                <tr>

                <td></td>
                <td></td>
                <td style="text-align:right;line-height:25px;"><b>Total: $<?php echo $amountPaid;?></b> </td>
                </tr>

                </tbody>
                </table>
                </body>
                </html>