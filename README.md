# Ateros Pay

## About
Ateros Pay is a payment gateway that allows you to accept 
online payments coming from multiple payment processors 
(like PayPal, Stripe, or Coinpayments).

## Installation
Add this to your ```composer.json``` file :
```json
{
  "repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/anto2oo/ateros-pay-client"
        }
    ]
}
```

Then just run :
```bash
composer require ateros/pay:dev-master
```

## Usage

Do not forget to include the library via the composer autoloader at the beginning of your file:
```php
require __DIR__ . 'vendor/autoload.php';
```

Then, you can start to play with objects from the Ateros\Pay\Objects namespace :
````php
use Ateros\Pay\Objects\Subscription;

$subscription = Subscription::create(['your-data']);
```` 