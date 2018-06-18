<?php

function getStars($rating) {

  // Round to nearest half
  $rating = round($rating * 2) / 2;
  $output = [];

  // Append all the filled whole stars
  for ($i = $rating; $i >= 1; $i--)
    $output[] = '<i class="fa fa-star" aria-hidden="true" style="color: gold;"></i>&nbsp;';

  // If there is a half a star, append it
  if ($i == .5) $output[] = '<i class="fa fa-star-half-o" aria-hidden="true" style="color: gold;"></i>&nbsp;';

  // Fill the empty stars
  for ($i = (5 - $rating); $i >= 1; $i--)
    $output[] = '<i class="fa fa-star-o" aria-hidden="true" style="color: gold;"></i>&nbsp;';

  return join("",$output);

}


function sendSMS($number, $message)
{
  // Account details
  $apiKey = urlencode('RJItAyWpWRI-snoxrIANb5EnQ5Zq7UJ0bDcjk7lOYM');
  
  // Message details
  
  $sender = urlencode('FOODOR');
  $message = rawurlencode($message);
 
  $number = '91' . $number;
  
  // Prepare data for POST request
  $data = array('apikey' => $apiKey, 'numbers' => $number, "sender" => $sender, "message" => $message);
 
  // Send the POST request with cURL
  $ch = curl_init('https://api.textlocal.in/send/');
  curl_setopt($ch, CURLOPT_POST, true);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $response = curl_exec($ch);
  curl_close($ch);
  
  // Process your response here
  return $response;
}

 function currentUrl() {
                $protocol = strpos(strtolower($_SERVER['SERVER_PROTOCOL']),'https') === FALSE ? 'http' : 'https';
                $host     = $_SERVER['HTTP_HOST'];
                $script   = $_SERVER['SCRIPT_NAME'];
                $params   = $_SERVER['QUERY_STRING'];

                return $protocol . '://' . $host . '/restaurants/explore' . '?' . 'lat=' . request('lat') . '&lng=' . request('lng');
            }




function check_in_range($start_date, $end_date, $date_from_user)
{
  // Convert to timestamp
  $start_ts = strtotime($start_date);
  $end_ts = strtotime($end_date);
  $user_ts = strtotime($date_from_user);

  // Check that user date is between start & end
  return (($user_ts >= $start_ts) && ($user_ts <= $end_ts));
}

function getCustomsString($customs)
{ 

    if($customs != null) {
    $msg = '';

    if(property_exists($customs, 'size'))
    {
       $msg = $msg . 'Size : ' . $customs->size . ' | '; 
    }

    foreach ($customs as $key => $custom) {
      
      if($key != 'price' && $key != 'size')
      {
        if(!is_array($custom))
        { 
           $msg = $msg . $key . ' : ' . $custom->name ;

             if($custom != end($customs))
             {
                 $msg = $msg . ', ';
             }
        } else {
          $msg = $msg . $key . ' : ';  
          foreach ($custom as $key => $choice) {

             $msg = $msg . $choice->name;

             if($choice != end($custom))
             {
                 $msg = $msg . ', ';
             }
          }
        }
       
      }

    } 

    

    return '<br><small>' . $msg . '</small>';

  }
}


