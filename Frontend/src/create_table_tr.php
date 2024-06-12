<?php

    //APIエンドポイント(本番環境では実際のドメインにする)
    $Schema = "http://";
    $Domain = "fastapi";
    $fastapi = $Schema.$Domain.":9004/api/kadai/";

    //APIから返ってくるデータを格納する変数と初期化
    $data = json_decode(file_get_contents($fastapi),true);
    
    //出力
    $html = "";

    //今日の日付を取得する
    $today = new DateTime();

    foreach($data as $value) {

        //差を計算
        $date = new DateTime($value["limit_date"]);
        $interval = $today -> diff($date);
        $limit_html = "";
        if($today < $date){
            $limit_html ="<td>".$interval->days."日</td>\n";          
        } else {
            $limit_html ="<td>期限切れ</td>\n";
        }        

        $html.="<tr>\n";
        $html.="<td>".$value["group"]."</td>\n";
        $html.="<td>".$value["title"]."</td>\n";
        $html.="<td>".$value["limit_date"]."</td>\n";
        $html.=$limit_html;

        if($value["status"] == 0){
            $html.="<td>未提出</td>\n";
        } else{
            $html.="<td>提出済み</td>\n";
        }

        $button = "";
        $button = '<td><form action="datails.php" method="post">
                        <input type="submit" name="submit" value="詳細">
                        <input type="hidden" name="kadai_id" id="kadai_id" value="'. $value["id"] .'">
                    </form></td>'; 
        $html.=$button;
        
    }

    return $html;
?>