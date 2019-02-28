<?php
namespace NexVortex\PhoneNumber\VerificationAPI;

interface PhoneVerificationInterface
{
  const SMS_TYPE = "sms";
  const CALL_TYPE = "call";

  public function start( $phone_number, $type);
  public function check( $phone_number, $code);
}