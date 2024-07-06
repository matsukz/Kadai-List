<?php
    function call_fastapi($api_point){

        $ch = curl_init();
        $curl_options = array(
            CURLOPT_URL => $api_point,
            CURLOPT_RETURNTRANSFER, true,
            CURLOPT_FOLLOWLOCATION, true
        );
        curl_setopt_array($ch,$curl_options);

        $response = curl_exec($ch); //curl実行
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        //レスポンスによって処理
        if($http_code == 200){
            return json_decode($response, true);
        } else {
            return $http_code;
        }

        curl_close($ch);
        
    }
?>