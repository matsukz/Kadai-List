<?php

    //APIエンドポイント(本番環境では実際のドメインにする)
    $Schema = "http://";
    $Domain = "fastapi";
    $fastapi = $Schema.$Domain.":9004/api/kadai/";

    //APIから返ってくるデータを格納する変数と初期化
    $data = json_decode(file_get_contents($fastapi),true);
    
    //出力
    $html = "";

    foreach($data as $value) {

        $html.="<tr>\n";
        $html.="<td>".$value["group"]."</td>\n";
        $html.="<td>".$value["title"]."</td>\n";
        $html.="<td>".$value["limit_date"]."</td>\n";
        $html.="<td>X日</td>\n";

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