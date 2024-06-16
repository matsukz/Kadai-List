document.getElementById("kadai-form").addEventListener("submit", function(event) {
    //formタグの送信阻止
    event.preventDefault();

    //ボタンを無効にする
    $("#Update").prop("disabled", true);
    $("btn-back").prop("disabled", true);
    //ボタンのテキストを変更する
    $("#Update").text("処理中...");

    //フォームのデータ取得
    var formData = new FormData(this);
    //空欄チェック用のフラグ
    let isEmpty = false;

    //空欄チェック
    for (let [key, value] of formData.entries()){
        if(key !== "kadai-memo" && !value.trim()){
            //空欄なので空欄チェックフラグを有効にする
            isEmpty = true;
        }
    }

    //空欄があることを警告し終了
    if(isEmpty){
        alert("すべて入力されていません");
        $("#Update").prop("disabled", false);
        $("#Update").text("登録");
        $("btn-back").prop("disabled", false);
        return false;
    }

    //データの取得 (name属性)
    const form_content = {
        "register_date": formData.get("kadai-registerday"),
        "start_date": formData.get("kadai-start"),
        "limit_date": formData.get("kadai-limit"),
        "group": formData.get("kadai-group"),
        "title": formData.get("kadai-title"),
        "content": formData.get("kadai-content"),
        "note": formData.get("kadai-memo"),
        "status": false
    }

    //JSONにする
    const post_content = JSON.stringify(form_content);

    console.log(post_content);
    return

    //APIサーバのドメインをセットする
    var url = new URL(window.location.href);
    var host = url.hostname;

    //新規登録APIを叩く(本番環境では変える)
    $.ajax({
        url: "http://" + host + ":9004/api/kadai/",
        type: "POST",
        contentType: "application/json",
        data: post_content,
        cache: false
    }).done(function(response){
        alert("登録が完了しました。\n トップページに戻ります。")
        window.location.href = "index.php";
        return
    }).fail(function(xhr, status, error){
        alert("新規登録に失敗しました。\n APIサーバーを確認してください。");
        console.error('AJAX Error:', status, error);
    }).always(function(){
        //いる？
        $("#Update").prop("disabled", false);
        $("#Update").text("登録");
    })

})