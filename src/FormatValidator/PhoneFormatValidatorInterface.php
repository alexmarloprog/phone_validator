<?php
namespace NexVortex\PhoneNumber\FormatValidator;

interface PhoneFormatValidatorInterface
{
  const US_FORMAT = "US";
  const RU_FORMAT = "RU";
  public function validate( $phone_number, $country_format);
}