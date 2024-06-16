document.getElementById("btn-success").onclick = function() {

    //ボタンのテキストを取得する
    const button_text = document.getElementById("btn-success").textContent;

    //ボタンを操作不可にする
    $("#btn-success").prop("disabled", true);
    $("#btn-update").prop("disabled", true);
    $("btn-delete").prop("disabled", true);
    //ボタンのテキストを変更する
    $("#btn-success").text("処理中...");

    //id取得
    const kadai_id = document.getElementById("kadai-id").value;

    //ステータスをチェック
    const status = Number(document.getElementById("kadai-status").value);
    
    if(status == 0){
        //ステータスを切り替えフラグ
        var status_flag = true;
    } else if (status == 1){
        var status_flag = false
    } else {
        alert("提出状況が有効ではありません。");
        //ボタンを有効に戻す
        $("#btn-success").prop("disabled", false);
        //ボタンのテキストを変更する
        $("#btn-success").text(button_text);
        return
    }

    //APIサーバー
    var url = new URL(window.location.href);
    var host = url.hostname;

    //状況更新APIを叩く
    $.ajax({
        url: "http://" + host + ":9004/api/kadai/process/" + kadai_id,
        type: "PUT",
        contentType: "application/json",
        data: JSON.stringify({"status": status_flag}),
        cache: false
    }).done(function(response){
        alert("更新が完了しました。");
        window.location.href = "index.php";
    }).fail(function(xhr, status, error){
        alert("更新に失敗しました。\n APIサーバを確認してください。");
        console.error('AJAX Error:', status, error);
    }).always(function(){
        //ボタンを有効に戻す
        $("#btn-success").prop("disabled", false);
        $("#btn-update").prop("disabled", false);
        $("btn-delete").prop("disabled", false);
        //ボタンのテキストを変更する
        $("#btn-success").text(button_text);
    })
}