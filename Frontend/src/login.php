<!DOCTYPE html>
<html lang="ja">
    <head>
        <title>課題一覧</title>
        <meta http-equiv="content-type" charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- スマホ版に対応させる -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js""></script>
        <?php include_once("create_table_tr.php"); ?>
    </head>
    <body>

        <br>
        <h1 class="text-center">ログイン</h1>
        <br>
            
        <div class="d-flex justify-content-center">
            <div class="col-10 col-mb-12">

                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">ID</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="login_user_id" name="login_user_id" required>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">PassWord</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" id="login_user_password" name="login_user_password" required>
                    </div>
                </div>

                <div class="d-grid gap-2 col-6 mx-auto d-md-block">
                    <button class="btn btn-primary" type="button" id="login_user_btn">ログイン</button>
                </div>

            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    </body>
</html>