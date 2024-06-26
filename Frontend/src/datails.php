<?php
    //APIエンドポイント(本番環境では実際のドメインにする)
    //タイトルタグで必要なのでHTMLの前にPHPを実行しておく。
    include("environment.php");
    $fastapi = $api_point.$_POST['kadai_id'];
    $data = "";
    $data = json_decode(file_get_contents($fastapi),true);

    //タイトル
    foreach ($data as $value){
        $id = $value["id"];
        $register_date = $value["register_date"];
        $start_date = $value["start_date"];
        $limit_date = $value["limit_date"];
        $group = $value["group"];
        $title = $value["title"];
        $content = $value["content"];
        $note = $value["note"];
        $status = $value["status"];
    }

    $limit_msg = $_POST["kadai_limit"];
?>
<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $title; ?></title>
        <meta http-equiv="content-type" charset="UTF-8">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    </head>
    <body>
        <div class="d-flex justify-content-center">
            <div class="container mt-3">
                <?php echo "<h1 class='text-center'>".$title."</h1>"; ?>

                    <table class="table">
                        <tbody>
                            <tr>
                                <td class="col-4"">登録ID</td>
                                <td class="col-8"><?php echo $id; ?></td>
                            </tr>
                            <tr>
                                <td class="col-4">登録日</td>
                                <td class="col-8"><?php echo $register_date; ?></td>
                            </tr>
                            <tr>
                                <td class="col-4">登録グループ</td>
                                <td class="col-8"><?php echo $group; ?></td>
                            </tr>
                            <tr>
                                <td class="col-4">内容</td>
                                <td class="col-8"><?php echo $content; ?></td>
                            </tr>
                            <tr>
                                <td class="col-4">メモ</td>
                                <td class="col-8"><?php echo $note; ?></td>
                            </tr>
                            <tr>
                                <td class="col-4">提出期限</td>
                                <td class="col-8"><?php echo $limit_date."（". $limit_msg ."）"; ?></td>
                            </tr>
                            <tr>
                                <td class="col-4">状況</td>
                                <td class="col-8"><?php if($status){echo "提出済み";}else{echo "未提出";} ?></td>
                            </tr>
                        </tbody>
                    </table>
                    
                    <!-- falseだけHTMLに出力されないの初見殺しすぎる -->
                    <input id="kadai-status" value=<?php echo $status ? "1":"0"; ?> hidden>
                    <input id="kadai-id" value=<?php echo $id; ?> hidden>

                <!-- 操作ボタン -->
                <div class="d-grid gap-2 col-6 mx-auto">
                    <?php
                        if($status){
                            //完了済みなら未完了化するボタンにする
                            echo '<button type="button" class="btn btn-danger" id="btn-success">未完了にする</button>';
                        } else {
                            echo '<button type="button" class="btn btn-success" id="btn-success">提出済みにする</button>';
                        }
                    ?>

                    <form action="update.php" method="POST">
                        <input id="kadai-id" name="kadai-id" value=<?php echo $id; ?> hidden>
                        <button type="submit" class="btn btn-warning w-100" id="btn-update">課題を編集</button> 
                    </form>
                    
                    <button type="button" class="btn btn-danger" id="btn-delete">課題を削除</button>
                </div>
                <div style="display: flex; justify-content: center;">
                    <button type="button" class="btn btn-secondary mt-3" id="btn-back" onclick="location.href='index.php'">戻る</button>
                </div>

            </div>
        </div>
        <script src="js/kadai_status_upd.js" type="module"></script>
        <script src="js/kadai_delete.js" type="module"></script>
    </body>
</html>