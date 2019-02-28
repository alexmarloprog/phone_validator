<?php
namespace NexVortex\PhoneNumber;

class PhoneValidator
{
  private $_verification_engine;
  private $_format_validator;

  function __construct(
    \NexVortex\PhoneNumber\VerificationAPI\PhoneVerificationInterface $verification_engine,
    \NexVortex\PhoneNumber\FormatValidator\PhoneFormatValidatorInterface $format_validator
  )
  {
    $this->_verification_engine = $verification_engine;
    $this->_format_validator = $format_validator;
  }

  public function validateStart( $phone_number, $validation_type = "sms")
  {
    if( !$this->validateFormat( $phone_number))
      return false;
    return $this->verifyStart( $phone_number, $validation_type);
  }

  public function validateEnd( $phone_number, $code)
  {
    if( !$this->validateFormat( $phone_number))
      return false;
    return $this->veryfyCheck( $phone_number, $code); 
  }

  public function validateFormat( $phone_number)
  {
    return $this->_format_validator->validate( $phone_number);
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