<?php

    function create_table($status){
        include("environment.php");
        include("call_api.php");
        $data = call_fastapi($api_point.$status);
    
        //返却値が数値のHTTPコードの場合は出力を変える
        if(gettype($data) == "integer"){
            switch($data){
                case 403:
                    return "<tr><td colspan=6>許可がありません(コード:403)</td></tr>";
                case 404:
                    return "<tr><td colspan=6>対象の課題が存在しません(コード:404)</td></tr>";
                case 444:
                    return "<tr><td colspan=6>APIサーバーからの応答がありません(コード:444)</td></tr>";
                case 500:
                    return "<tr><td colspan=6>APIサーバーでエラーが発生しました(コード:500)</td></tr>";
                default:
                    return "<tr><td colspan=6>不明なエラーが発生しました</td></tr>";
            }        
        }
    
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
    }
?>