<?php

    //APIエンドポイント(本番環境では実際のドメインにする)
    include("environment.php");
    $fastapi = $api_point;
    
    //APIから返ってくるデータを格納する変数と初期化
    $data = json_decode(file_get_contents($fastapi),true);
    
    //出力
    $html = "";
    

    //今日の日付を取得する(タイムゾーンをセットし時刻は無視する)
    $timezone = new DateTimeZone("Asia/Tokyo");
    $today = (new DateTime("now" , $timezone));

    foreach($data as $value) {

        $limit_html = ""; //残日数をいれる変数を初期化する
        
        //提出期限取得
        $limit = (new datetime($value["limit_date"], $timezone));
        $date_diff = $today -> diff($limit);

        //今日の日付と比較する
        if($today->format("Y-m-d") <= $limit->format("Y-m-d")){
            $limit_html.="あと".$date_diff->days."日";
        } else if ($today->format("Y-m-d") > $limit->format("Y-m-d")){
            $limit_html.="期限切れ";
        } else {
            $limit_html.="エラー";
        }

        $html.="<tr>\n";
        $html.="<td>".$value["group"]."</td>\n";
        $html.="<td>".$value["title"]."</td>\n";
        $html.="<td>".$value["limit_date"]."</td>\n";
        $html.="<td>".$limit_html."</td>";
        $html.="\n";

        if($value["status"]){
            $html.="<td>提出済み</td>\n";
        } else{
            $html.="<td>未提出</td>\n";
        }

        $button = "";
        $button = '<td><form action="datails.php" method="post">
                        <input type="submit" name="submit" value="詳細">
                        <input type="hidden" name="kadai_id" id="kadai_id" value="'. $value["id"] .'">
                        <input type="hidden" name="kadai_limit" id="kadai_limit" value="' .$limit_html. '">
                    </form></td>'; 
        $html.=$button;
        
    }

    return $html;
?>