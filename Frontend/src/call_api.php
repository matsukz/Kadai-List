<?php
    function call_fastapi($api_point){

        $ch = curl_init();
        $curl_options = array(
            CURLOPT_URL => $api_point,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_TIMEOUT => 10
        );
        curl_setopt_array($ch,$curl_options);

        $response = curl_exec($ch); //curl実行
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        //タイムアウト
        if (curl_error($ch)) { return 444; }

        //レスポンスによって処理
        if($http_code == 200){
            return json_decode($response, true);
        } else {
            return $http_code;
        }

        curl_close($ch);
        
    }
?>