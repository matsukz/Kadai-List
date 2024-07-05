<?php
    //メソッドのチェック(POST以外ならindex.phpへ)
    if($_SERVER["REQUEST_METHOD"] != "POST") {
        header("Location: index.php");
        exit();
    }

    include("environment.php");

    $fastapi = $api_point.$_POST['kadai-id'];
    $data = "";
    $data = json_decode(file_get_contents($fastapi),true);

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
?>

<!DOCTYPE html>
<html lang="ja">
    <head>
        <title><?php echo $title."を編集"; ?></title>
        <meta http-equiv="content-type" charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    </head>
    <body>
        <h1 class="text-center"><?php echo $title."を編集"; ?></h1>
        <div class="d-flex justify-content-center">
            <div class="col-10 col-mb-12">
                <form id="kadai-form">
                    <!-- 課題のタイトル -->
                    <div class="mb-3">
                        <label for="kadai-title-for" class="form-label">タイトル</label>
                        <input type="text" class="form-control" id="kadai-title" name="kadai-title" maxlength="20" value=<?php echo $title; ?> required>
                    </div>

                    <!-- グループ -->
                    <div class="mb-3">
                        <label for="kadai-group-for" class="form-label">グループ</label>
                        <input type="text" class="form-control" id="kadai-group" name="kadai-group" maxlength="20" value=<?php echo $group; ?> required>
                    </div>

                    <!-- 内容 -->
                    <div class="mb-3">
                        <label for="kadai-content-for" class="form-label">課題の内容</label>
                        <textarea class="form-control" id="kadai-content" name="kadai-content" rows="2" maxlength="100" required><?php echo $content; ?></textarea>
                    </div>

                    <!-- 開始日 -->
                    <div class="mb-3">
                        <label for="kadai-start-for" class="form-label">課題開始日</label>
                        <input type="date" class="form-control" id="kadai-start" name="kadai-start" value=<?php echo $start_date; ?> required>
                    </div>

                    <!-- 期限日 -->
                    <div class="mb-3">
                        <label for="kadai-start-for" class="form-label">提出期限</label>
                        <input type="date" class="form-control" id="kadai-limit" name="kadai-limit" value=<?php echo $limit_date; ?> required>
                    </div>

                    <!-- メモ -->
                    <div class="mb-3">
                        <label for="kadai-memo-for" class="form-label">メモ</label>
                        <input type="text" class="form-control" id="kadai-memo" name="kadai-memo" value=<?php echo '"'.$note.'"' ; ?> maxlength="20">
                    </div>

                    <!-- 登録日とステータスとidは非公開 -->
                    <!-- $status ? "1":"0" ; true->1 false->0 -->
                    <input id="kadai-id" name="kadai-id" value=<?php echo $_POST['kadai-id']; ?> hidden>                 
                    <input id="kadai-registerday" name="kadai-registerday" value=<?php echo $start_date; ?> hidden>
                    <input id="kadai-status" name="kadai-status" value=<?php echo $status ? "1":"0" ; ?> hidden>

                    <!-- 登録ボタン -->
                    <div class="d-grid gap-2 col-6 mx-auto">
                        <button type="submit" class="btn btn-primary" id="Update">登録</button>
                    </div>
                    <div style="display: flex; justify-content: center;">
                        <button type="button" class="btn btn-secondary mt-3" id="btn-back" onclick="location.href='index.php'">戻る</button>
                    </div>
                </form>
            </div>
        </div>

    <!-- JS読み込み -->
     <script src="js/kadai_upd.js" type="module"></script>
    </body>
</html>