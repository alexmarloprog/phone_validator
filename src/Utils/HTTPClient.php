<?php 
namespace NexVortex\PhoneNumber\Utils;

class HTTPClient
{
  static public function get( $url, $params)
  {
    return self::request( $url, $params);
  }

  static public function post( $url, $params)
  {
    return self::request( $url, $params, "POST");
  }

  static public function request( $url, $params, $method = "GET")
  {
    $curl = \curl_init();
    $query = \http_build_query($params);
    if( \strtolower($method) == "get")
    {
      \curl_setopt($curl, CURLOPT_URL, $url . "?" . $query);
      \curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
    }
    else
    {
      $header = ["Content-Type: application/x-www-form-urlencoded"];
      \curl_setopt($curl, CURLOPT_URL, $url);
      \curl_setopt($curl, CURLOPT_POST, TRUE);
      \curl_setopt($curl, CURLOPT_POSTFIELDS, $query);
      \curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
    }

    \curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
    \curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
    \curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
    \curl_setopt($curl, CURLOPT_TIMEOUT, 30);
    $response = \curl_exec($curl);
    $result = ($response === FALSE) ? \curl_error($curl) : $response;
    \curl_close($curl);
    return $result;
  }
}