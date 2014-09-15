An example for sending an order to Riskified using node.js, until we have a full SDK.
For the reference please see [our api reference we site](http://apiref.riskified.com/)

###Usage:  
  
1. Configure your Riskified account credentials (on Sandbox) in [webhook_example.js](webhook_example.js) with the following:  
  - *shopDomain* - is the Riskified account user name
  - *authToken* - is the auto generated token you can find in Riskified Web App, under [Settings->Advance Setting](https://sandbox.riskified.com/#settings/advanced)
  ```js
  var authToken = YOUR AUTH TOKEN;
  var shopDomain = YOUR SHOP DOMAIN;
  ```
2. Run it
```sh
node webhook_example.js
```
