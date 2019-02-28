<?php
namespace NexVortex\PhoneNumber;

use \NexVortex\PhoneNumber\VerificationAPI\PhoneVerificationInterface;
use \NexVortex\PhoneNumber\FormatValidator\PhoneFormatValidatorInterface;

class PhoneValidator
{
  private $_verification_engine;
  private $_format_validator;

  function __construct(
    PhoneVerificationInterface $verification_engine,
    PhoneFormatValidatorInterface $format_validator
  )
  {
    $this->_verification_engine = $verification_engine;
    $this->_format_validator = $format_validator;
  }

  public function validateStart( $phone_number, $validation_type = PhoneVerificationInterface::SMS_TYPE, $country_format = PhoneFormatValidatorInterface::US_FORMAT)
  {
    if( !in_array( $validation_type, [PhoneVerificationInterface::SMS_TYPE, PhoneVerificationInterface::CALL_TYPE]))
      return false;

    if( !$this->validateFormat( $phone_number, $country_format))
      return false;
    return $this->verifyStart( $phone_number, $validation_type);
  }

  public function validateEnd( $phone_number, $code, $country_format = PhoneFormatValidatorInterface::US_FORMAT)
  {
    if( !$this->validateFormat( $phone_number, $country_format))
      return false;
    return $this->veryfyCheck( $phone_number, $code); 
  }

  public function validateFormat( $phone_number, $country_format = PhoneFormatValidatorInterface::US_FORMAT)
  {
    if( !in_array( $country_format, [PhoneFormatValidatorInterface::US_FORMAT, PhoneFormatValidatorInterface::RU_FORMAT]))
      return false;
    
    return $this->_format_validator->validate( $phone_number, $country_format);
  }

  private function verifyStart( $phone_number, $validation_type)
  {
    return $this->_verification_engine->start( $phone_number, $validation_type);
  }

  private function veryfyCheck( $phone_number, $code)
  {
    return $this->_verification_engine->check( $phone_number, $code);
  }
}