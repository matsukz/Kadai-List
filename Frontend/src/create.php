<!DOCTYPE html>
<html>
    <head>
        <title>新規登録</title>
        <meta http-equiv="content-type" charset="UTF-8">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    </head>
    <body>
        <h1 class="text-center">新規登録</h1>
        <div class="d-flex justify-content-center">
            <div class="container mt-3">
                <form>

                    <!-- 課題のタイトル -->
                    <div class="mb-3">
                        <label for="kadai-title-for" class="form-label">タイトル</label>
                        <input type="text" class="form-control" id="kadai-title" maxlength="20">
                    </div>

                    <!-- グループ -->
                    <div class="mb-3">
                        <label for="kadai-group-for" class="form-label">グループ</label>
                        <input type="text" class="form-control" id="kadai-group" maxlength="20">
                    </div>

                    <!-- 内容 -->
                    <div class="mb-3">
                        <label for="kadai-content-for" class="form-label">課題の内容</label>
                        <textarea class="form-control" id="kadai-content" rows="2" maxlength="100"></textarea>
                    </div>

                    <!-- 開始日 -->
                    <div class="mb-3">
                        <label for="kadai-start-for" class="form-label">課題開始日</label>
                        <input type="date" class="form-control" id="kadai-start">
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </body>
</html>