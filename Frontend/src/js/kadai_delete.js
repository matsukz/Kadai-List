//環境変数もどきの読み込み
import { api_point } from "./environment.js";

document.getElementById("btn-delete").onclick = function() {
    //ボタンのテキストを取得する
    const button_text = document.getElementById("btn-delete").textContent;

    //ボタンを操作不可にする
    $("#btn-success").prop("disabled", true);
    $("#btn-update").prop("disabled", true);
    $("#btn-delete").prop("disabled", true);
    //ボタンのテキストを変更する
    $("#btn-delete").text("処理中...");

    //id取得
    const kadai_id = document.getElementById("kadai-id").value;

    //状況更新APIを叩く
    $.ajax({
        url: api_point + kadai_id,
        type: "DELETE",
        contentType: "application/json",
        data: JSON.stringify({"id": kadai_id}),
        cache: false
    }).done(function(response){
        alert(kadai_id + "を削除しました。");
        window.location.href = "index.php";
    }).fail(function(xhr, status, error){
        alert("削除に失敗しました。\n APIサーバを確認してください。");
        console.error('AJAX Error:', status, error);
    }).always(function(){
        //ボタンを有効に戻す
        $("#btn-success").prop("disabled", false);
        $("#btn-update").prop("disabled", false);
        $("#btn-delete").prop("disabled", false);
        //ボタンのテキストを変更する
        $("#btn-delete").text(button_text);
    })
}