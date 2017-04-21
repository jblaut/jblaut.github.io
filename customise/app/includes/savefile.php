<?php
# code from https://support.ladesk.com/061754-How-to-make-REST-calls-in-PHP?r=1
$service_url = 'http://www.myapifilms.com/imdb/top?start=1&end=250&token=72dff507-0f89-4d9a-b53b-6f83e8d7e6ac&format=json&data=1';
$curl = curl_init($service_url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$curl_response = curl_exec($curl);
if ($curl_response === false) {
    $info = curl_getinfo($curl);
    curl_close($curl);
    die('error occured during curl exec. Additioanl info: ' . var_export($info));
}
curl_close($curl);
$results = json_decode($curl_response);

$fp = fopen('response.json', 'w+');
fwrite($fp, json_encode($results));
fclose($fp);
?>
