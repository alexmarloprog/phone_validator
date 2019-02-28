<?php
namespace NexVortex\PhoneNumber\FormatValidator;

class LibPhoneNumberFormatValidator implements PhoneFormatValidatorInterface
{
  private $_phone_utils;

  function __construct()
  {
    $this->_phone_utils = \libphonenumber\PhoneNumberUtil::getInstance();
  }

  public function validate( $phone_number, $country = "US")
  {
    try
    {
      $phone_number_proto = $this->_phone_utils->parse( $phone_number, $country);
      $is_valid = $this->_phone_utils->isValidNumber( $phone_number_proto);

      return $is_valid;
    }
    catch ( \libphonenumber\NumberParseException $e)
    {
      return false;
    }
  }
}