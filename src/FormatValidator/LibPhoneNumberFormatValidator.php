<?php
namespace NexVortex\PhoneNumber\FormatValidator;

class LibPhoneNumberFormatValidator implements PhoneFormatValidatorInterface
{
  public function validate( $phone_number)
  {
    $phoneUtil = \libphonenumber\PhoneNumberUtil::getInstance();
    try {
        $phoneNumberProto = $phoneUtil->parse($phone_number, "US");
        $isValid = $phoneUtil->isValidNumber($phoneNumberProto);
        return $isValid;
    } catch (\libphonenumber\NumberParseException $e) {
        return false;
    }
  }
}