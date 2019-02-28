# Phone Validator

## About

Phone Validator is simple module for PHP to validate phone number format and to verify it
with phone call or sms code.

## Usage

### Validate phone number

```php
// Send an SMS using Twilio's REST API and PHP
<?php
use \NexVortex\PhoneNumber\VerificationAPI;
use \NexVortex\PhoneNumber\FormatValidator;

$api_key = "kjaskfkl;jsd;lakj3";

$phone_verification = new TwillioPhoneVerificationAPI( $api_key);
$phone_format_validator = new LibPhoneNumberFormatValidator();

$validator = new \NexVortex\PhoneNumber\PhoneValidator( $phone_verification, $phone_format_validator);

$phone_number = "+1 415 333 3333";
// Send verification code via sms
print($validator->validateStart( $phone_number, "sms"));

// Check verification code
print($validator->validateEnd( $phone_number, "2345"));
```

### Only format validation

```php
<?php
use \NexVortex\PhoneNumber\VerificationAPI;
use \NexVortex\PhoneNumber\FormatValidator;

$api_key = "kjaskfkl;jsd;lakj3";

$phone_verification = new TwillioPhoneVerificationAPI( $api_key);
$phone_format_validator = new LibPhoneNumberFormatValidator();

$validator = new \NexVortex\PhoneNumber\PhoneValidator( $phone_verification, $phone_format_validator);

$phone_number = "+1 415 333 3333";
print($validator->validateFormat( $phone_number));
```

## Testing

### Run tests in console

```
runtest.sh
```

### Test with cli script
To run some tests in console we can use manual_verify.php.
For now we use only Twillio API:
```
php cli/manual_verify.php [twillio API key] [phone number] [type:sms,call,code] [code]
```
To get verification code:
```
php cli/manual_verify.php ajkhflkajsdhfkljhasdf 415424-4763 sms
```
To get verify with existing code:
```
php cli/manual_verify.php ajkhflkajsdhfkljhasdf 415424-4763 code 2344
```
## Prerequisites

* PHP >= 5.6
