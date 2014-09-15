/*
 * Copyright 2013-2014 Riskified.com, Inc. or its affiliates. All Rights Reserved.
 *
 * Licensed under the Apache License, Version 2.0 (the "License").
 * You may not use this file except in compliance with the License.
 * A copy of the License is located at
 *
 * http://www.apache.org/licenses/LICENSE-2.0.html
 *
 * or in the "license" file accompanying this file. This file is distributed
 * on an "AS IS" BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either
 * express or implied. See the License for the specific language governing
 * permissions and limitations under the License.
 */

// A Riskified API v2 sample usage.

// Configure your shop settings and the riskified environment you work
// against.
var riskifiedBaseUrl = "https://sandbox.riskified.com";
var authToken = "AUTH_TOKEN";
var shopDomain = "my.shop.domain";


var request = require("request");
var crypto = require("crypto");
var _ = require("lodash");
var order = require("./sample_order.json");

/*
 * createHmac:
 *
 *   Creates verification hash from the supplied auth_token
 *   and data.
 */
function createHmac(token, data) {
  return crypto.createHmac('sha256', token).update(data).digest('hex');
}

/*
 * generateRequest:
 *
 *   Generates object that matches the input for the 'request'
 *   library.
 */
function generateRequest(path, order) {
  var orderString = JSON.stringify({'order': order});
  verificationHash = createHmac(authToken, orderString);

  return {
    url: riskifiedBaseUrl + path,
    body: orderString,
    headers: {
      "Content-Type": "application/json",
      "ACCEPT": "application/vnd.riskified.com; version=2",
      "X_RISKIFIED_SHOP_DOMAIN": shopDomain,
      "X_RISKIFIED_HMAC_SHA256": verificationHash
    },
    method: 'POST'
  };
}

/*
 * Partially applied funciton to generate create-order request. The
 * same could be created for the other API actions.
 */
var generateCreateOrderRequest = _.partial(generateRequest, "/api/create");

// Create the order
var createOrderRequest = generateCreateOrderRequest(order);
request(createOrderRequest, function(err, res) {
  if (err) {
    return console.error(err);
  }

  var body = JSON.parse(res.body);
  if (res.statusCode === 200) {
    if (body.warnings) {
      console.log("WARNINGS:");
      body.warnings.forEach(function(msg) {
        console.log("* " + msg);
      });
    }
    console.log(body.order);
  } else {
    console.log("ERROR:");
    console.log("* " + body.error.message);
  }
});
