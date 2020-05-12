# Paynow Ecocash Payments Service

This little service allows you to accepts ecocash payments on your website through [Paynow](https://paynow.co.zw), without you having to worry about the programming. Before using this service you must be registered with Paynow and have your ID and Key at the ready.

## Official Documentation

This service only has one endpoint `POST /v1/payments`. Here's the base URL `https://paynow-ecocash-payments.herokuapp.com`, you can also use it to discover the API on your own.

- `paynow_integration_id` : The ID of your integration as provided by Paynow. This field is required
- `paynow_integration_key` : Your Paynow integration key as provided by paynow. This field is required
- `customer_number` : The EcoCash phone number of the user you're charging in the format 0777777777. This field is required
- `amount` : The amount you're charging the user/customer. Example 700.98. This field is required

Here's a screenshot for reference

![example postman screenshot](https://raw.githubusercontent.com/Berzel/paynow-ecocash-payments-service/master/docs/paynow-ecocash-payments.png)

That's all.
