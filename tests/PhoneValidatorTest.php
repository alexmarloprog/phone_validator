<?php
namespace NexVortex\PhoneNumber\Tests;
use \NexVortex\PhoneNumber\PhoneValidator as PhoneValidator;
use \NexVortex\PhoneNumber\VerificationAPI\PhoneVerificationInterface as PhoneVerificationInterface;
use \NexVortex\PhoneNumber\FormatValidator\PhoneFormatValidatorInterface as PhoneFormatValidatorInterface;

class PhoneVerificationMock implements PhoneVerificationInterface
{
  public $start = true;
  public $check = true;

  public function start( $phone_number, $type)
  {
  	return $this->start;
  }

  public function check( $phone_number, $code)
  {
  	return $this->check;
  }
}

class PhoneFormatValidatornMock implements PhoneFormatValidatorInterface
{
  public $is_valid = true;

  public function validate( $phone_number, $country = "US")
  {
  	return $this->is_valid;
  }
}

class PhoneValidatorTest extends \PHPUnit\Framework\TestCase
{
  public function testGoodValidate()
  {
  	$phone_verification_mock = new PhoneVerificationMock();
    $phone_format_validatorn_mock = new PhoneFormatValidatornMock();

  	$validator = new PhoneValidator( $phone_verification_mock, $phone_format_validatorn_mock);
  	$phone_number = "+1 415 333 3333";
  	$code = "2411";
    $this->assertTrue( $validator->validateStart( $phone_number));
    $this->assertTrue( $validator->validateEnd( $phone_number, $code));
  }

  public function testBadVerificationTypeValidate()
  {
    $phone_verification_mock = new PhoneVerificationMock();
    $phone_format_validatorn_mock = new PhoneFormatValidatornMock();

    $validator = new PhoneValidator( $phone_verification_mock, $phone_format_validatorn_mock);
    $phone_number = "+1 415 333 3333";
    $this->assertFalse( $validator->validateStart( $phone_number, "asdasd"));
  }

  public function testGoodValidateFormat()
  {
  	$phone_verification_mock = new PhoneVerificationMock();
    $phone_format_validatorn_mock = new PhoneFormatValidatornMock();

  	$validator = new PhoneValidator( $phone_verification_mock, $phone_format_validatorn_mock);
  	$phone_number = "+1 415 333 3333";
    $this->assertTrue( $validator->validateFormat( $phone_number));
  }

  public function testGoodLibPhoneNumberFormatValidator()
  {
    $phone_verification_mock = new PhoneVerificationMock();
    $phone_format_validator = new \NexVortex\PhoneNumber\FormatValidator\LibPhoneNumberFormatValidator();;

    $validator = new PhoneValidator( $phone_verification_mock, $phone_format_validator);
    $phone_number = "+1 415 333 3333";
    $this->assertTrue( $validator->validateFormat( $phone_number));
    $phone_number = "415 333 3333";
    $this->assertTrue( $validator->validateFormat( $phone_number));
    $phone_number = "asfdsafasdf";
    $this->assertFalse( $validator->validateFormat( $phone_number));
    $phone_number = "";
    $this->assertFalse( $validator->validateFormat( $phone_number));

    $phone_number = "+5 415 333 3333";
    $this->assertFalse( $validator->validateFormat( $phone_number, "IN"));

    $phone_number = "+7 415 333 3333";
    $this->assertTrue( $validator->validateFormat( $phone_number, "RU"));

  }
}