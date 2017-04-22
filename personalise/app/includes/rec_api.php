<?php 
$user_id = $_GET['id'];
# code from https://support.ladesk.com/061754-How-to-make-REST-calls-in-PHP?r=1
$service_url = 'https://nfomheyj0h.execute-api.eu-west-1.amazonaws.com/prod/recommendation?user_id=' . $user_id;
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
$recommendations = $results->recommendations;
?>
