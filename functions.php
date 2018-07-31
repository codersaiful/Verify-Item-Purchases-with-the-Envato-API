<?php

/**
 * Generate an Array from a Right Purchase Code
 * Remember: To this function, you have to configure your Username and your API Key. Actually we will get 
 * data from http://marketplace.envato.com/api/edge/[USERNAME]/[API-KEY]/verify-purchase:[PURCHASE_KEY].json this format url.
 * Hope: this linke will be helpful for you.
 * 
 * @link https://codecanyon.net/user/[your_username]/api_keys/edit If you Themeforest user, than replace codecanyon to themeforest
 * @link https://build.envato.com/api/ Envato API Documentation
 * @author Saiful Islam <codersaiful@gmail.com>
 * @param String $customer_purchase_code
 * @return Array get_purchasecode_output() will be return an Array, If Correct Purchase code
 */
function get_purchasecode_output($customer_purchase_code = false) {

    $own_username = 'codersaiful'; //Use your username.
    $own_api_key = 'aaaaaaaaj5z3so6yv4aaaaaaao3ye4'; //It's just a sample and fake api key. Use your API here. follow function's instruction


    $json_url = "http://marketplace.envato.com/api/edge/{$own_username}/{$own_api_key}/verify-purchase:{$customer_purchase_code}.json";

    //Obpen Curl Channel
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $json_url);

    //Set user Agent for device
    $agent = 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1)';
    curl_setopt($ch, CURLOPT_USERAGENT, $agent);
    
    //For non echo output, without this(CURLOPT_RETURNTRANSFER => TRUE) Header , Automatically generate echo
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    //Curl Execute
    $curl_execute = curl_exec($ch);
    curl_close($ch);
    $convertArray = json_decode($curl_execute, true);

    
    if(!isset($convertArray['verify-purchase']['buyer'])){
        return false;
    }
    
    return $convertArray['verify-purchase'];
}

/**
 * This function is not related to Envato API, I have collencted this function 
 * from https://stackoverflow.com/questions/8273804/convert-seconds-into-days-hours-minutes-and-seconds
 * 
 * @param Int $inputSeconds
 * @return String 
 */
function secondsToTime($inputSeconds) {
    $secondsInAMinute = 60;
    $secondsInAnHour = 60 * $secondsInAMinute;
    $secondsInADay = 24 * $secondsInAnHour;

    // Extract days
    $days = floor($inputSeconds / $secondsInADay);

    // Extract hours
    $hourSeconds = $inputSeconds % $secondsInADay;
    $hours = floor($hourSeconds / $secondsInAnHour);

    // Extract minutes
    $minuteSeconds = $hourSeconds % $secondsInAnHour;
    $minutes = floor($minuteSeconds / $secondsInAMinute);

    // Extract the remaining seconds
    $remainingSeconds = $minuteSeconds % $secondsInAMinute;
    $seconds = ceil($remainingSeconds);

    // Format and return
    $timeParts = [];
    $sections = [
        'day' => (int)$days,
        'hour' => (int)$hours,
        'minute' => (int)$minutes,
        'second' => (int)$seconds,
    ];

    foreach ($sections as $name => $value){
        if ($value > 0){
            $timeParts[] = $value. ' '.$name.($value == 1 ? '' : 's');
        }
    }

    return implode(', ', $timeParts);
}
