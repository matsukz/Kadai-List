<!DOCTYPE html>
<html lang="ja">
    <head>
        <title>新規登録</title>
        <meta http-equiv="content-type" charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    </head>
    <body>
        <h1 class="text-center">新規登録</h1>
        <div class="d-flex justify-content-center">
            <div class="col-10 col-mb-12">
                <form id="kadai-form">
                    <!-- 課題のタイトル -->
                    <div class="mb-3">
                        <label for="kadai-title-for" class="form-label">タイトル</label>
                        <input type="text" class="form-control" id="kadai-title" name="kadai-title" maxlength="20" required>
                    </div>

                    <!-- グループ -->
                    <div class="mb-3">
                        <label for="kadai-group-for" class="form-label">グループ</label>
                        <input type="text" class="form-control" id="kadai-group" name="kadai-group" maxlength="20" required>
                    </div>

                    <!-- 内容 -->
                    <div class="mb-3">
                        <label for="kadai-content-for" class="form-label">課題の内容</label>
                        <textarea class="form-control" id="kadai-content" name="kadai-content" rows="2" maxlength="100" required></textarea>
                    </div>

                    <!-- 開始日 -->
                    <div class="mb-3">
                        <label for="kadai-start-for" class="form-label">課題開始日</label>
                        <input type="date" class="form-control" id="kadai-start" name="kadai-start" value=<?php echo (new DateTime())->format("Y-m-d"); ?> required>
                    </div>

                    <!-- 期限日 -->
                    <div class="mb-3">
                        <label for="kadai-start-for" class="form-label">提出期限</label>
                        <input type="date" class="form-control" id="kadai-limit" name="kadai-limit" required>
                    </div>

                    <!-- メモ -->
                    <div class="mb-3">
                        <label for="kadai-memo-for" class="form-label">メモ</label>
                        <input type="text" class="form-control" id="kadai-memo" name="kadai-memo" maxlength="20">
                    </div>

                    <!-- 登録日は非公開 -->
                    <input id="kadai-registerday" name="kadai-registerday" value=<?php echo (new DateTime())->format("Y-m-d"); ?> hidden>

                    <!-- 登録ボタン -->
                    <div class="d-grid gap-2 col-6 mx-auto">
                        <button type="submit" class="btn btn-primary" id="Register">登録</button>
                    </div>
                    <!-- 戻るボタン -->
                    <div style="display: flex; justify-content: center;">
                        <button type="button" class="btn btn-secondary mt-3" id="btn-back" onclick="history.back()">戻る</button>
                    </div>
                </form>
            </div>
        </div>

    <!-- JS読み込み -->
    <script src="js/kadai_create.js" type="module"></script>
    </body>
</html>