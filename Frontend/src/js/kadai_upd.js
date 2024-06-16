//環境変数もどきの読み込み
import { api_point } from "./environment.js";

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
    //statusは文字列で取得するので文字列-数値->真偽値 の順で変換する
    const form_content = {
        "register_date": formData.get("kadai-registerday"),
        "start_date": formData.get("kadai-start"),
        "limit_date": formData.get("kadai-limit"),
        "group": formData.get("kadai-group"),
        "title": formData.get("kadai-title"),
        "content": formData.get("kadai-content"),
        "note": formData.get("kadai-memo"),
        "status": Boolean(Number(formData.get("kadai-status")))
    }

    //JSONにする
    const post_content = JSON.stringify(form_content);

    //更新APIを叩く
    $.ajax({
        url: api_point + formData.get("kadai-id"),
        type: "PUT",
        contentType: "application/json",
        data: post_content,
        cache: false
    }).done(function(response){
        alert(formData.get("kadai-id") + "を更新しました。\n詳細ページへ戻ります。");

        //datails.phpはkadai-idをpostしないとエラーになる。
        var tojamp_form = $("<form>",{
            action: "datails.php",
            method: "POST"
        });

        tojamp_form.append($("<input>", {
            type: "hidden",
            name: "kadai_id",
            value: formData.get("kadai-id")
        }));

        tojamp_form.appendTo("body");
        tojamp_form.submit();

    }).fail(function(xhr, status, error){
        alert("更新に失敗しました。\n APIサーバーを確認してください。");
        console.error('AJAX Error:', status, error);
    }).always(function(){
        //いる？
        $("#Update").prop("disabled", false);
        $("#Update").text("更新");
        $("btn-back").prop("disabled", false);
    })
})