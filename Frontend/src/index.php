<!DOCTYPE html>
<html>
    <head>
        <title>sample</title>
        <meta http-equiv="content-type" charset="UTF-8">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js""></script>
    </head>
    <body>

        <br>
        <h1 class="text-center">課題一覧へようこそ！</h1>
        <br>

        <div class="container-fluid">
            <!-- 新規作成画面に行くボタン -->
            <div class="d-flex justify-content-end">
                <button type="button" class="btn btn-primary" onclick="window.location.href='create.php'">新規登録</button>
            </div>

            <div class="col-12">

                <table class="table text-center">
                    <thead>
                        <tr>
                            <th scope="col">グループ</th>
                            <th scope="col">タイトル</th>
                            <th scope="col">課題期限</th>
                            <th scope="col">残日数</th>
                            <th scope="col">状態</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- テーブルの中身はphp"に任せる -->
                        <?php $value = include "create_table_tr.php"; echo $value; ?>
                    </tbody>
                </table>
            </div>

        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    </body>
</html>