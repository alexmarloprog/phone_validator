<?php
namespace NexVortex\PhoneNumber\FormatValidator;

interface PhoneFormatValidatorInterface
{
  public function validate( $phone_number);
}