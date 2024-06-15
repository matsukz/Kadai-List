document.getElementById("btn-update").onclick = function() {

    //ボタンのテキストを取得する
    const button_text = document.getElementById("btn-update").textContent;

    //ボタンを操作不可にする
    $("#btn-update").prop("disabled", true);
    //ボタンのテキストを変更する
    $("#btn-updater").text("処理中...");

    //ステータスをチェック
    const status = Number(document.getElementById("kadai-status"));
    
    if(status == 0){
        //ステータスを切り替えフラグ
        var status_flag = true;
    } else if (status == 1){
        var status_flag = false
    } else {
        alert("提出状況が有効ではありません。");
        //ボタンを有効に戻す
        $("#btn-update").prop("disabled", false);
        //ボタンのテキストを変更する
        $("#btn-updater").text(button_text);
        return
    }

    //送信するjsonデータの用意
    var status_data = {
        "status": status_flag
    }
    const put_date = JSON.stringify(status_data);

    //APIサーバー
    var url = new URL(window.location.href);
    var host = url.hostname;

    //状況更新APIを叩く
    $.ajax({
        url: "http://" + host + ":9004/api/kadai/progress"
    })



}