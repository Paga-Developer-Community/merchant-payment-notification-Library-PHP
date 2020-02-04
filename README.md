# merchant-payment-notification-Library-PHP
The Merchant Payment Notification API enables merchants to integrate with the Paga platform. This is a PHP library  enables Paga to process automated real-time payment transactions with the Merchant's systems using secure RestFul Web Services.
##How to set up the webservice
1.Create a folder like merchantPaymentNotification inside web directory eg. /var/www/html
2.copy the two files merchantPaymentNotificationService.php and .htaccess into merchantPaymentNotification

##How to call the end points
1.There are four end points /getIntegrationServices, /validateCustomer, /getMerchantServices, and /submitTransaction
1.1. call end points

url=https://yourservername.com/merchantPaymentNotification/merchantPaymentNotificationService/<end_point_name>

Headers:
Authorization: "Basic xxxxxxxxxxxxxxxxxxxxxxxxxxxxx"
Content-Type: "application/json"
Accept: "application/json"

for further info Please visit: https://developer-docs.paga.com/docs/services
