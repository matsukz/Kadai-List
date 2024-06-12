<!DOCTYPE html>
<html>
    <head>
        <title>sample</title>
        <meta http-equiv="content-type" charset="UTF-8">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    </head>
    <body>
        <br>
        <?php
            //APIエンドポイント(本番環境では実際のドメインにする)
            $Schema = "http://";
            $Domain = "fastapi";
            $fastapi = $Schema.$Domain.":9004/api/kadai/".$_POST['kadai_id'];
            $data = "";
            $data = json_decode(file_get_contents($fastapi),true);
            
            //タイトル
            foreach ($data as $value){
                echo "<h1 class='text-center'>".$value["title"]."</h1>";
            }
        ?>

    </body>
</html>