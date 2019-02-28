<?php
namespace NexVortex\PhoneNumber\VerificationAPI;

class TwillioPhoneVerificationAPI implements PhoneVerificationInterface
{
  //TODO move to config file
  private $api_key;
  private $api_url;
  private $country_code;
  private $locale;

  private $start_endpoint = 'start';
  private $check_endpoint = 'check';
  
  public function __construct(
    $api_key,
    $api_url = "https://api.authy.com/protected/json/phones/verification",
    $country_code = 1,
    $locale = "en")
  {
    $this->api_key = $api_key;
    $this->api_url = $api_url;
    $this->country_code = $country_code;
    $this->locale = $locale;
  }

  public function start( $phone_number, $type = "sms")
  {
    $params = [
      "api_key" => $this->api_key,
      "via" => $type,
      "phone_number" => $phone_number,
      "country_code" => $this->country_code,
      "locale" => $this->locale
    ];

    $response = \NexVortex\PhoneNumber\Utils\HTTPClient::post( $this->api_url."/".$this->start_endpoint , $params);
    $result = json_decode( $response, true);
var_dump($response);
    if( $result and isset($result["success"]))
      return $result["success"];
    else
      return false;
  }

  public function check( $phone_number, $code)
  {
    $params = [
      "api_key" => $this->api_key,
      "phone_number" => $phone_number,
      "country_code" => $this->country_code,
      "verification_code" => $code
    ];

    $response = \NexVortex\PhoneNumber\Utils\HTTPClient::get( $this->api_url."/".$this->check_endpoint, $params);
var_dump($response);
    $result = json_decode( $response, true);

    if( $result and isset($result["success"]))
      return $result["success"];
    else
      return false;
  }
}