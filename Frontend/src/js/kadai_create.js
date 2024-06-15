document.getElementById("kadai-form").addEventListener("submit", function(event) {
    //formタグの送信阻止
    event.preventDefault();

    //フォームのデータ取得
    var formData = new FormData(this);

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