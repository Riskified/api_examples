import json
import urllib2
import hmac
import hashlib

# A simple script to submit an order to Riskified
# 
# This example is a very simple hello world example that demonstrates the basic submission of an order to Riskified for review.
# Customize for you own needs.

def create_hmac(auth_token,data):
  "HMAC for the message"
  return hmac.new(auth_token, data, hashlib.sha256).hexdigest()

def build_order_data():
  # The data hash should be built according to the fields specified in the integration spec.
  data = {
      "id": 399, # Is unique. If it is not, the API will update the order with the same ID.
      "name":"name",
      "email":"email@email.com",
      "total_spent":"1",
      "cancel_reason":"cancel_reason",
      "created_at":"2014-05-04 145804",
      "closed_at":"closed_at",
      "currency":"usd",
      "updated_at":"updated_at",
      "gateway":"gateway",
      "browser_ip":"12.23.34.45",
      "cart_token":"cart_token",
      "note":"note",
      "referring_site":"referring_site",
      "total_price":"113.23",
      "total_discounts":"5",
      "discount_codes":"discount_codes",
      "line_items":
      [
        {"price":1, "product_id":1, "quantity":1, "sku":"sku", "title":"title"},
        {"price":100, "product_id":101, "quantity":1, "sku":"sku", "title":"title"}
      ],
      "shipping_lines":
      [
        {"price":10, "title":"title"}
      ],
      "payment_details": 
      {
        "credit_card_bin":"370002",
        "avs_result_code":"Y",
        "cvv_result_code":"N",
        "credit_card_number":"XXXX-XXXX-1234",
        "credit_card_company":"VISA"
      },
      "customer":
      {
        "created_at":"31/1/2012",
        "email":"greatcustomer@example.com",
        "first_name":"first_name",
        "id":"customer_id",
        "last_name":"last_name",
        "orders_count":10
      },
      "billing_address":
      {
        "first_name":"billing first name",
        "last_name":"billing last name",
        "name":"billing name",
        "address1":"address1",
        "address2":"address2",
        "company":"company",
        "country":"country",
        "country_code":"country_code",
        "phone":"phone",
        "province":"province",
        "province_code":"province_code",
        "city":"city",
        "zip":"zip"
      },
      "shipping_address":
      {
        "first_name":"first_name",
        "last_name":"last_name",
        "name":"name",
        "address1":"address1",
        "address2":"address2",
        "company":"company",
        "country":"country",
        "country_code":"country_code",
        "phone":"phone",
        "city":"city",
        "province":"province",
        "province_code":"province_code",
        "zip":"zip"
      }
  }
  print data
  return json.dumps(data)

def send_order_to_riskified( riskified_url, shop_url, auth_token, data_json, do_submit ):
  url = 'http://' + riskified_url + '/webhooks/merchant_order_created'
  signature = create_hmac( auth_token, data_json )
  print "signature: " + signature
  options = {
      'content-type': 'application/json',
      'Accept' : 'application/json',
      'X_RISKIFIED_SHOP_DOMAIN' : shop_url,
      'X_RISKIFIED_HMAC_SHA256' : signature
  }
  
  # When the order is recieved, it should be labeled is captured.
  # If you want to submit an order, set the do submit to true.
  # If you are on an automatic plan by Riskified, when the order is captured, it will be submitted automatically by Riskified
  if do_submit:
    options['X_RISKIFIED_SUBMIT_NOW'] = 'true'

  req = urllib2.Request( url, data_json, options )
  response_stream = urllib2.urlopen(req)
  json_response = response_stream.read()
  return json_response

# -----------------------------------------------------------------------------
# Main

# The riskified server. For production, use "wh.riskified.com"
riskified_server_url="sandbox.riskified.com"

# The login name to riskified.
shop_url="merchant.com" 

# Taken from your Riskified account.
auth_token="354e3f9a8ba75b616a0b135d6f44addc"

data_json = build_order_data()
print data_json
json_response = send_order_to_riskified( riskified_server_url, shop_url, auth_token, data_json, False ) 
print json_response
