<?php
 
/* Function By Qassim Hassan, wp-time.com */
function Qassim_HTTP($method, $url, $header, $data, $json){
if( $method == 1 ){
$method_type = 1; // 1 = POST
}else{
$method_type = 0; // 0 = GET
}
 
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($curl, CURLOPT_HEADER, 0);
 
if( $header !== 0 ){
curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
}
 
curl_setopt($curl, CURLOPT_POST, $method_type);
 
if( $data !== 0 ){
curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
}
 
$response = curl_exec($curl);
 //print_r($response);
if( $json == 0 ){
$json = $response;
}else{
$json = json_decode($response, true);
}
 
curl_close($curl);
 
return $json;
}

/* Function By Qassim Hassan, wp-time.com */
function Qassim_HTTP2($method, $url, $header, $data, $json){
if( $method == 1 ){
$method_type = 1; // 1 = POST
}else{
$method_type = 0; // 0 = GET
}
 
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($curl, CURLOPT_HEADER, 0);
 
if( $header !== 0 ){
curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
}
 
curl_setopt($curl, CURLOPT_POST, $method_type);
 
if( $data !== 0 ){
curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
}
 
$response = curl_exec($curl);
//print_r($response);exit();
if( $json == 0 ){
$json = $response;
}else{
$json = json_decode($response, true);
}
 
curl_close($curl);
 
return $json;
}
 
?>