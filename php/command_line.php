<?php

// A simple example of creating an order from the command line.
// Run using php command_line.php

if(defined('STDIN') ) 
  echo("Running from CLI"); 
else 
  echo("Not Running from CLI"); 

$domain = "test.magento.com";
$auth_token = "YOUR AUTH TOKEN";

$data = array();
$data['id'] 			= 111;
$data['name'] 			= '111';
$data['email']			= "eyal@riskified.com";
$data['total_spent']	= 200;
/*$data['created_at']		= $order_model->getCreatedAt();
$data['updated_at']		= $order_model->getUpdatedAt();
$data['gateway']		= "authorize.net";
$data['browser_ip']		= "4.4.4.4";
$data['buyer_accepts_marketing']	=NULL;
$data['cancel_reason']	=NULL;
$data['cancelled_at']	=NULL;
$data['cart_token']		=NULL;
$data['closed_at']		=NULL;
$data['currency']		=$order_model->getBaseCurrencyCode();
$data['financial_status']=NULL;
$data['fulfillment_status']	=NULL;
$data['landing_site']	="/";
$data['note']			= $order_model->getCustomerNote();
$data['number']			=NULL;
$data['reference']		=NULL;
$data['referring_site']	=NULL;
$data['source']			=NULL;
$data['subtotal_price']	= $order_model->getBaseSubtotalInclTax();
$data['taxes_included']	=TRUE;
$data['token']			=NULL;
$data['total_discounts']= $order_model->getDiscountAmount();
$data['total_line_items_price']	= $order_model->getGrandTotal();
$data['total_price']	=$order_model->getGrandTotal();
$data['total_price_usd']=$order_model->getGrandTotal();
$data['total_tax']		=$order_model->getBaseTaxAmount();
$data['total_weight']	= $order_model->getWeight();
$data['user_id']		=$order_model->getCustomerId();
$data['landing_site_ref']=NULL;
$data['order_number']	=$order_model->getId();
$data['discount_codes']	=$order_model->getDiscountDescription();
$data['note_attributes'] = NULL;
$data['processing_method'] = NULL;
$data['checkout_id']	=NULL;

// line items
foreach ($order_model->getItemsCollection() as $key => $val)
{
  $data['line_items'][]['fulfillment_service']	=NULL;
  $data['line_items'][]['fulfillment_status']	=NULL;
  $data['line_items'][]['grams']	= $val->getWeight();
  $data['line_items'][]['id']	= $val->getItemId();
  $data['line_items'][]['price']	= $val->getPrice();
  $data['line_items'][]['product_id']	= $val->getItemId();
  $data['line_items'][]['quantity']	= $val->getQtyOrdered();
  $data['line_items'][]['requires_shipping']	=NULL;
  $data['line_items'][]['sku']	= $val->getSku();
  $data['line_items'][]['title']	= $val->getName();
  $data['line_items'][]['variant_id']	=NULL;
  $data['line_items'][]['variant_title']	=NULL;
  $data['line_items'][]['vendor']	= $order_model->getStoreName();
  $data['line_items'][]['name']	= $val->getName();
  $data['line_items'][]['variant_inventory_management']	=NULL;
  $data['line_items'][]['properties']	=NULL;
}

//shipping details
$data ['shipping_lines'][]['code']	= $order_model->getShippingMethod();
$data ['shipping_lines'][]['price']	= $order_model->getShippingAmount();
$data ['shipping_lines'][]['source']	= NULL;
$data ['shipping_lines'][]['title']	= $order_model->getShippingDescription();
$data['tax_lines']	= NULL;

// payment details
$payment_details = $order_model->getPayment();

$bin_number = 

  $data['payment_details']['credit_card_bin']	= $payment_details['bin_number'];
$data['payment_details']['avs_result_code']	= $payment_details['cc_avs_result_code'];
$data['payment_details']['cvv_result_code']	= $payment_details['cc_response_code'];
$data['payment_details']['cvv_result_code']	= $payment_details['paypal_cvv2_match'];
$data['payment_details']['credit_card_number']	= "XXXX-XXXX-".$payment_details['cc_last4'];
$data['payment_details']['credit_card_company']= $payment_details['cc_type'];

$data['fulfillments']	=NULL;

// client details
$data['client_details']['accept_language']	=NULL;
$data['client_details']['browser_ip']	= $order_model->getRemoteIp();;
$data['client_details']['session_hash']	=NULL;
$data['client_details']['user_agent']	= $order_model->getHttpUserAgent();


$data['customer']['accepts_marketing']	=NULL;
$data['customer']['created_at']	= $customer_details->getCreatedAt();
$data['customer']['email']	= $customer_details->getEmail();
$data['customer']['first_name']	=$customer_details->getFirstname();
$data['customer']['id']	= $customer_details->getEntityId();
$data['customer']['last_name']	= $customer_details->getLastname();

$customer_details = load($customer_id);
$total = 0;
foreach ($customer_order_details as $num => $entity_id){
  $last_id = $entity_id->getData('entity_id');
  $total = $total+$entity_id->getData('base_grand_total');
}

$data['customer']['last_order_id']	=$last_id;
$data['customer']['note']	=NULL;
$data['customer']['orders_count']	= ++$num;
$data['customer']['state']	=NULL;
$data['customer']['total_spent']	= $total;
$data['customer']['updated_at']	= $customer_details->getUpdatedAt();
$data['customer']['tags']	=NULL;
$data['customer']['last_order_name']	=NULL;


//billing info
$billing_address = $order_model->getBillingAddress();
$add = $billing_address->getStreet();

$data['billing_address']['first_name'] 	= $billing_address->getFirstname();
$data['billing_address']['last_name']	= $billing_address->getLastname();
$data['billing_address']['name']   	    = $data['billing_address']['first_name'] . " " . $data['billing_address']['last_name'];
$data['billing_address']['address1'] 	= $add['0'];
$data['billing_address']['address2'] 	= $add['1'];
$data['billing_address']['city'] 		= $billing_address->getCity();
$data['billing_address']['company'] 	= $billing_address->getCompany();
$data['billing_address']['country'] 	= getCountyById($billing_address->getCountryId())->getName();
$data['billing_address']['country_code']= $billing_address->getCountryId();
$data['billing_address']['phone'] 		= $billing_address->getTelephone();
$data['billing_address']['province'] 	= $billing_address->getRegion();
$data['billing_address']['zip'] 		= $billing_address->getPostcode();
$data['billing_address']['province']	= NULL;

//shipping info
$shipping_address = $order_model->getShippingAddress();
$sadd = $shipping_address->getStreet();

$data['shipping_address']['first_name'] = $shipping_address->getFirstname();
$data['shipping_address']['last_name'] 	= $shipping_address->getLastname();
$data['shipping_address']['name']   	= $data['shipping_address']['first_name'] . " " . $data['shipping_address']['last_name'];
$data['shipping_address']['address1'] 	= $sadd['0'];
$data['shipping_address']['address2'] 	= $sadd['1'];
$data['shipping_address']['city'] 		= $shipping_address->getCity();
$data['shipping_address']['company'] 	= $shipping_address->getCompany();
$data['shipping_address']['country'] 	= getCountyById($shipping_address->getCountryId())->getName();
$data['shipping_address']['country_code'] = $shipping_address->getCountryId();
$data['shipping_address']['phone'] 		= $shipping_address->getTelephone();
$data['shipping_address']['province'] 	= $shipping_address->getRegion();
$data['shipping_address']['zip'] 		= $shipping_address->getPostcode();
$data['shipping_address']['province_code'] =NULL;
 */
// json encode
$data_string = json_encode($data);

//generating hash 
$hash_code = hash_hmac('sha256', $data_string, $auth_token);

$ch = curl_init('http://s.riskified.com/webhooks/merchant_order_created');
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
  'Content-Type: application/json',
  'Content-Length: ' . strlen($data_string),
  'X_RISKIFIED_SHOP_DOMAIN:'.$domain,
  'X_RISKIFIED_HMAC_SHA256:'.$hash_code)
);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

$result = curl_exec($ch);
?>
