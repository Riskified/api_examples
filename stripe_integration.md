<h3>Stripe gateway integration</h3>

In order to review charges Riskified requires name and address saved for the card.<br>
We also require that you add the following metadata hash to the charge:

```ruby
Stripe::Charge.create(amount: 100, 
		      currency: 'usd',
		      customer: 'cus_2xRw4xWfm7ybdg',
		      metadata: {shipping_address: '{"name": “Dennis Duffy", 
		                                     "city": "San Francisco",
		                                     "line1": "1 main st",
		                                     "line2":"",
		                                     "phone":"917-917-9177",
		                                     "zip":"99999",
		                                     "state":"CA",
		                                     "country":"US",
		                                     "company":""}', 
		                 billing_company: '',
		                 billing_phone: '917-917-9177',
		                 email: 'dennis@riskified.com',
		                 browser_ip: '200.123.123.113'})
```

