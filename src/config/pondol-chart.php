<?php

return [
  'prefix' => '',
  'middleware' => ['web', 'auth'],
  'chart'=>['name' => 'chartjs', 'ver'=>'4'],

  /*
  |--------------------------------------------------------------------------
  | Maxmind database
  |--------------------------------------------------------------------------
  */
  'user_id' => env('MAXMIND_USER_ID', ''),
  'license_key' => env('MAXMIND_LICENSE_KEY', ''),
  'permalink_ASN' => env('GeoLite2_ASN', 'https://download.maxmind.com/geoip/databases/GeoLite2-ASN/download?suffix=tar.gz'),
  'permalink_City' => env('GeoLite2_City', 'https://download.maxmind.com/geoip/databases/GeoLite2-City/download?suffix=tar.gz'),
  'permalink_Country' => env('GeoLite2_Country', 'https://download.maxmind.com/geoip/databases/GeoLite2-Country/download?suffix=tar.gz'),
];
