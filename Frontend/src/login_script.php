<?php

    if($_SERVER["REQUEST_METHOD"] == "GET"){ return http_response_code(500); }

    $login_data = array(
        "username" => $_POST["username"],
        "password" => $_POST["password"]
    );

    include("environment.php");

    $ch = curl_init();
    $curl_options = array(
        CURLOPT_URL => $api_point."auth/token",
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => http_build_query($login_data),
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT => 10
    );
    curl_setopt_array($ch,$curl_options);

    $response = curl_exec($ch);
    curl_close($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    if(curl_errno($ch)){
        return http_response_code(503);
    }

    if($http_code == 200){
        try{
            $response_json = json_decode($response,true);
            $token = $response_json["access_token"];
            //ini_set("session.gc_maxlifetime", 1440);
            var_dump($token);            
        } catch (Exception $ex) {
            return http_response_code(502);
        }
    } else {
        return http_response_code(504);
    }
?>