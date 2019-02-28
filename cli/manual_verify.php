<?php

require 'vendor/autoload.php';

if( !$argc || $argc < 4)
{
    echo( "Error, no params!!\nExamples:\nmanual_verify.php [API Key] 415624-5763 sms\nmanual_verify.php [API Key] 415426-4763 code 23432\n");
    return;
}

$api_key = $argv[1];
$phone_number = $argv[2];
$type = $argv[3];

if( $type == "code" && $argc < 3)
{
	echo( "Error, no code!!\nExample manual_verify.php [API Key] 415445-4763 code 2343\n");
  return;
}

if( !in_array( $type, ["sms", "call", "code"]))
{
	echo( "Error, wrong request type!!\nType must be one of sms, call, code\n");
  return;
}

$phone_verification = new \NexVortex\PhoneNumber\VerificationAPI\TwillioPhoneVerificationAPI( $api_key);
$phone_format_validator = new \NexVortex\PhoneNumber\FormatValidator\LibPhoneNumberFormatValidator();

$validator = new \NexVortex\PhoneNumber\PhoneValidator( $phone_verification, $phone_format_validator);

if( $type == "code")
{
	$code = $argv[4];
	$result = $validator->validateEnd( $phone_number, $code);
}
else
	$result = $validator->validateStart( $phone_number, $type);

echo( "Validation result: ".($result?"success":"error")."\n");