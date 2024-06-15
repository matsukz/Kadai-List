document.getElementById("kadai-form").addEventListener("submit", function(event) {
    //formタグの送信阻止
    event.preventDefault();

    //ボタンを無効にする
    $("#Register").prop("disabled", true)
    //ボタンのテキストを変更する
    $("#Register").text("処理中...");

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
        $("#Register").prop("disabled", false);
        $("#Register").text("登録");
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
        "status": 0
    }

    //JSONにする
    const post_content = JSON.stringify(form_content);



})