<?php
namespace NexVortex\PhoneNumber\VerificationAPI;

interface PhoneVerificationInterface
{
  public function start( $phone_number, $type);
  public function check( $phone_number, $code);
}