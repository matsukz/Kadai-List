<?php
    //APIエンドポイント(本番環境では実際のドメインにする)
    //タイトルタグで必要なのでHTMLの前にPHPを実行しておく。
    $Schema = "http://";
    $Domain = "fastapi";
    $fastapi = $Schema.$Domain.":9004/api/kadai/".$_POST['kadai_id'];
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
            <div class="container p-4">
                <?php echo "<h1 class='text-center'>".$title."</h1>"; ?>

                <div class="col-8">

                    <table class="table text-center">
                        <thead class="table-bordered">
                        </thead>
                        <tbody>
                            <tr>
                                <td>登録ID</td>
                                <td><?php echo $id; ?></td>
                            </tr>
                            <tr>
                                <td>登録日</td>
                                <td><?php echo $register_date; ?></td>
                            </tr>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </body>
</html>