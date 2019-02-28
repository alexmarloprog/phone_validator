<?php
namespace NexVortex\PhoneNumber\VerificationAPI;

class TwillioPhoneVerificationAPI implements PhoneVerificationInterface
{
  //TODO move to config file
  private $_api_key;
  private $_api_url;
  private $_country_code;
  private $_locale;

  private $_start_endpoint = 'start';
  private $_check_endpoint = 'check';
  
  public function __construct(
    $api_key,
    $api_url = "https://api.authy.com/protected/json/phones/verification",
    $country_code = 1,
    $locale = "en")
  {
    $this->_api_key = $api_key;
    $this->_api_url = $api_url;
    $this->_country_code = $country_code;
    $this->_locale = $locale;
  }

  public function start( $phone_number, $type = "sms")
  {
    $params = [
      "api_key" => $this->_api_key,
      "via" => $type,
      "phone_number" => $phone_number,
      "country_code" => $this->_country_code,
      "locale" => $this->_locale
    ];

    $response = \NexVortex\PhoneNumber\Utils\HTTPClient::post( $this->_api_url."/".$this->_start_endpoint , $params);
    $result = json_decode( $response, true);

    if( $result and isset($result["success"]))
      return $result["success"];
    else
      return false;
  }

  public function check( $phone_number, $code)
  {
    $params = [
      "api_key" => $this->_api_key,
      "phone_number" => $phone_number,
      "country_code" => $this->_country_code,
      "verification_code" => $code
    ];

    $response = \NexVortex\PhoneNumber\Utils\HTTPClient::get( $this->_api_url."/".$this->_check_endpoint, $params);

    $result = json_decode( $response, true);

    if( $result and isset($result["success"]))
      return $result["success"];
    else
      return false;
  }
}