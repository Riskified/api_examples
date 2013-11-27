```ruby
Stripe::Charge.create(amount: 100, 
		      currency: 'usd',
		      customer: 'cus_2xRw4xWfm7ybdg',
		      metadata: {shipping_address: '{"name": “[SHIPPING NAME]", 
		                                     "city": "[SHIPPING CITY]",
		                                     "line1": "SHIPPNING LINE1]",
		                                     "line2":"near 3",
		                                     "name":"Asaf Schers",
		                                     "phone":"0542201918",
		                                     "zip":"12345",
		                                     "state":"Israel",
		                                     "country":"Israel",
		                                     "company":"Riskified"}', 
		                 billing_company: 'Riskified',
		                 billing_phone: '033456434',
		                 email: 'schers@riskified.com',
		                 browser_ip: '200.123.123.113‘})
```
