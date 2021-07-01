<?php

function getPrice(){
  $url = 'https://pro-api.coinmarketcap.com/v1/cryptocurrency/quotes/latest';
  $id = strval(2010); //insert the coinmarketcap id the coin you want
  $parameters = [
    'id' => $id
  ];

  $headers = [
    'Accepts: application/json',
    'X-CMC_PRO_API_KEY: xxx_your-API-key_xxx' //insert your API key
  ];
  $qs = http_build_query($parameters); // query string encode the parameters
  $request = "{$url}?{$qs}"; // create the request URL


  $curl = curl_init(); // Get cURL resource
  // Set cURL options
  curl_setopt_array($curl, array(
    CURLOPT_URL => $request,            // set the request URL
    CURLOPT_HTTPHEADER => $headers,     // set the headers
    CURLOPT_RETURNTRANSFER => 1         // ask for raw response instead of bool
  ));

  $response = curl_exec($curl); // Send the request, save the response
  $response = json_decode($response); // print json decoded response

//  $id = strval(2010); //needed because Ints are not pointable
  $adaPrice = ($response->data->$id->quote->USD->price); //points to the correct value (ada price)
  return $adaPrice;
  curl_close($curl); // Close request
  }
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>getPrice</title>
  </head>
  <body>
    <h1>Get the price from one Coin</h1>
    <br>
    <p><?php print_r("Cardano price: " . getPrice()); ?></p>
  </body>
</html>
