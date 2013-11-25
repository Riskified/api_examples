<?php

// A simple example of creating an order from the command line.
// Run using php command_line.php


if(defined('STDIN') ) 
  echo("Running from CLI\n"); 
else 
  echo("Not Running from CLI"); 

$domain = "magento.riskified.com";
$auth_token = "dddd";
$is_production_mode = false; // Determines whether to send the request to the sandbox account or the production account.

$riskified_url = "sandbox.riskified.com";
if ($is_production_mode) {
  $riskified_url = "app.riskified.com";
}
echo ("Riskified URL is $riskified_url\n");

// Fill NULL fields if this information is available.
// Fill other field with the information you have.
$data = array();
$data['id'] 			              = 111;
$data['name'] 			            = 'Order #111';
$data['email']			            = "great.customer@example.com";
$data['total_spent']	          = 200;
$data['created_at']             = "2013-10-13 14:58:04";
$data['currency']               = "USD";
$data['updated_at']             = "2013-10-13 14:58:04";
$data['gateway']		            = "mypaymentprocessor"; // paypal, authorize.net, ...
$data['browser_ip']		          = "124.185.86.55";
$data['buyer_accepts_marketing']= NULL;
$data['cancel_reason']	        = NULL;
$data['cancelled_at']	          = NULL;
$data['cart_token']		          = '1sdaf23j212';
$data['closed_at']		          = NULL;
$data['financial_status']       = NULL;
$data['fulfillment_status']	    = NULL;
$data['landing_site']	          = "/";
$data['landing_site_ref']       = NULL;
$data['note']                   = "Shipped to my hotel.";
$data['number']			            = NULL;
$data['order_number']	          = "1000200304";
$data['reference']	          	= NULL;
$data['referring_site']	        = "google.com";
$data['source']			            = NULL;
$data['subtotal_price']         = 102.12;
$data['taxes_included']	        = TRUE;
$data['token']			            = NULL;
$data['total_line_items_price'] = 102.12;
$data['total_price']	          = 113.23;
$data['total_price_usd']        = 113.23;
$data['total_discounts']        = 5;
$data['total_tax']              = 5;
$data['total_weight']           = "2 lbs.";
$data['user_id']                = "1211";
$data['discount_codes']         = "Black Friday";
$data['note_attributes']        = NULL;
$data['processing_method']      = NULL;
$data['checkout_id']	          = NULL;

// line items - multiple items can be added.
$data['line_items'][0]['fulfillment_service']	          = NULL;
$data['line_items'][0]['fulfillment_status']	          = NULL;
$data['line_items'][0]['grams']                         = 100;
$data['line_items'][0]['id']	                          = 1011;
$data['line_items'][0]['price']	                        = 100;
$data['line_items'][0]['product_id']	                  = 101;
$data['line_items'][0]['quantity']	                    = 1;
$data['line_items'][0]['requires_shipping']	            = true;
$data['line_items'][0]['sku']	                          = "ABCD";
$data['line_items'][0]['title']	                        = "ACME Widget";
$data['line_items'][0]['variant_id']	                  = NULL;
$data['line_items'][0]['variant_title']      	          = NULL;
$data['line_items'][0]['vendor']	                      = "ACME";
$data['line_items'][0]['name']	                        = "ACME Widget";
$data['line_items'][0]['variant_inventory_management']	= NULL;
$data['line_items'][0]['properties']	                  = NULL;

$data['line_items'][1]['fulfillment_service']	          = NULL;
$data['line_items'][1]['fulfillment_status']	          = NULL;
$data['line_items'][1]['grams']                         = 90;
$data['line_items'][1]['id']	                          = 1012;
$data['line_items'][1]['price']	                        = 100;
$data['line_items'][1]['product_id']	                  = 101;
$data['line_items'][1]['quantity']	                    = 1;
$data['line_items'][1]['requires_shipping']	            = true;
$data['line_items'][1]['sku']	                          = "ABCD";
$data['line_items'][1]['title']	                        = "ACME Widget";
$data['line_items'][1]['variant_id']	                  = NULL;
$data['line_items'][1]['variant_title']      	          = NULL;
$data['line_items'][1]['vendor']	                      = "ACME";
$data['line_items'][1]['name']	                        = "ACME Widget";
$data['line_items'][1]['variant_inventory_management']	= NULL;
$data['line_items'][1]['properties']	                  = NULL;

//shipping details
$data ['shipping_lines'][]['code']	 = "1";
$data ['shipping_lines'][]['price']	 = 10;
$data ['shipping_lines'][]['source'] = "Fed Ex";
$data ['shipping_lines'][]['title']	 = "Overnight shipping";
$data['tax_lines']	                 = NULL;

// payment details
$data['payment_details']['credit_card_bin']	    = "370002";
$data['payment_details']['avs_result_code']	    = "Y";
$data['payment_details']['cvv_result_code']	    = "N";
$data['payment_details']['credit_card_number']  = "XXXX-XXXX-"."1234"; // We never store or look at full credit card numbers.
$data['payment_details']['credit_card_company'] = "VISA";
$data['fulfillments']	                          = NULL;

// client details
$data['client_details']['accept_language'] = "English";
$data['client_details']['browser_ip']	     = "124.185.86.55";
$data['client_details']['session_hash']	   = NULL;
$data['client_details']['user_agent']	     = "Mozilla/5.0 (Windows NT 6.2; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/32.0.1667.0 Safari/537.36";

$data['customer']['accepts_marketing'] = NULL;
$data['customer']['created_at']	       = "31/1/2012";
$data['customer']['email']	           = "greatcustomer@example.com";
$data['customer']['first_name']	       = "Gary";
$data['customer']['id']	               = "1211";
$data['customer']['last_name']	       = "Great";

$data['customer']['last_order_id']   = 103;
$data['customer']['note']	           = NULL;
$data['customer']['orders_count']	   = 12;
$data['customer']['state']	         = NULL;
$data['customer']['total_spent']	   = 1400;
$data['customer']['updated_at']	     = "1/1/2009";
$data['customer']['tags']	           = NULL;
$data['customer']['last_order_name'] = NULL;

//billing info
$data['billing_address']['first_name']   = 'Gary';
$data['billing_address']['last_name']	   = 'Great';
$data['billing_address']['name']   	     = "Gary Great"; // Can also be a formula such as first name + last name
$data['billing_address']['address1'] 	   = '108 Main Street';
$data['billing_address']['address2'] 	   = 'Apartment 12';
$data['billing_address']['city'] 		     = 'Kansas City';
$data['billing_address']['company'] 	   = "Kansas Computers";
$data['billing_address']['country'] 	   = 'United States';
$data['billing_address']['country_code'] = 'US';
$data['billing_address']['phone'] 		   = '12345345';
$data['billing_address']['province'] 	   = 'MI';
$data['billing_address']['zip'] 		     = '64155';
$data['billing_address']['province']	   = 'MI';

// Shipping address
$data['shipping_address']['first_name']    = "Jane";
$data['shipping_address']['last_name'] 	   = "Great";
$data['shipping_address']['name']   	     = "Jane Great";
$data['shipping_address']['address1'] 	   = "192 Main Street";
$data['shipping_address']['address2'] 	   = "Apartemnt 10";
$data['shipping_address']['city'] 		     = "Kansas City";
$data['shipping_address']['company'] 	     = "";
$data['shipping_address']['country'] 	     = "United States";
$data['shipping_address']['country_code']  = "US";
$data['shipping_address']['phone'] 		     = "12345566";
$data['shipping_address']['province'] 	   = "MI";
$data['shipping_address']['zip'] 		       = "12345";
$data['shipping_address']['province_code'] = NULL;

$data_string = json_encode($data);

// Generating the signing hash 
$hash_code = hash_hmac('sha256', $data_string, $auth_token);

// Send the request
$ch = curl_init("http://$riskified_url/webhooks/merchant_order_created");
curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
  'Content-Type: application/json',
  'Content-Length: ' . strlen($data_string),
  'X_RISKIFIED_SHOP_DOMAIN:'.$domain,
  'X_RISKIFIED_HMAC_SHA256:'.$hash_code)
);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

echo("Sending request...\n");
$result = curl_exec($ch);
echo("Result is $result\n");

$decodedResponse = json_decode($result);
if(isset($decodedResponse->order))
{
  $orderId = $decodedResponse->order->id;
  $status = $decodedResponse->order->status;
  echo("Order $orderId status is $status\n");
}

?>
