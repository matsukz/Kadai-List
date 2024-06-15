document.getElementById("btn-success").onclick = function() {

    //ボタンのテキストを取得する
    const button_text = document.getElementById("btn-success").textContent;

    //ボタンを操作不可にする
    $("#btn-success").prop("disabled", true);
    //ボタンのテキストを変更する
    $("#btn-successr").text("処理中...");

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
        $("#btn-successr").text(button_text);
        return
    }

    //送信するjsonデータの用意↓消す
    var status_data = {
        "status": status_flag
    }
    const put_date = JSON.stringify(status_data);

    //APIサーバー
    var url = new URL(window.location.href);
    var host = url.hostname;

    //状況更新APIを叩く
    // $.ajax({
    //     url: "http://" + host + ":9004/api/kadai/progress/" + kadai_id
    // })
}