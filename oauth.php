<?php
require_once 'config.php';

session_start();

$auth_url = LOGIN_URI
        . "/services/oauth2/authorize?response_type=code&client_id="
        . CLIENT_ID . "&redirect_uri=" . urlencode(REDIRECT_URI);
                
$loginurl = "https://login.salesforce.com/services/oauth2/token";

$params = "grant_type=password"
. "&client_id=" . CLIENT_ID
. "&client_secret=" . CLIENT_SECRET
. "&username=" . SF_USER
. "&password=" . SF_PWD . SECURITY_TOKEN
. "&redirect_uri=" . urlencode(REDIRECT_URI);

$curl = curl_init($loginurl);
curl_setopt($curl, CURLOPT_HEADER, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $params);

$json_response = curl_exec($curl);
$token_request_data = json_decode($json_response, true);

$status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

if ( $status != 200 ) {
    die("Error: call to URL failed with status $status, response $json_response, curl_error " . curl_error($curl) . ", curl_errno " . curl_errno($curl));
}

if (empty($token_request_data))
    die("Couldn't decode '$token_request_data' as a JSON object");
echo 'Access token: ' . $token_request_data['access_token'];
echo 'Instance URL: ' . $token_request_data['instance_url'];

if (!isset($token_request_data['access_token'])||
    !isset($token_request_data['instance_url']))
    die("Missing expected data from ".print_r($token_request_data, true));

// Save off the values we need for future use
echo '<br />Access token: ' . $token_request_data['access_token'];
echo '<br />Instance URL: ' . $token_request_data['instance_url'] . '<br />';
$_SESSION['access_token'] = $token_request_data['access_token'];
$_SESSION['instance_url'] = $token_request_data['instance_url'];

curl_close($curl);

echo var_dump($token_request_data);

// Redirect to the main page without the code in the URL
//header( 'Location: demo_rest.php' ) ;
header('Location: ' . REDIRECT_URI);
//header('Location: '. $auth_url);
?>