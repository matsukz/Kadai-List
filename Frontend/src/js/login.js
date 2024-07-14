import { api_point } from "./environment.js"

document.getElementById("login").addEventListener("submit", function(event){
    event.preventDefault();
    
    $("#Register").prop("disabled", true);
    $("#Register").text("処理中...");
    
    const login_id = document.getElementById("login_user_id").value;
    const login_password = document.getElementById("login_user_password").value;

    if(!login_id || !login_password){
        alert("入力が不完全です");
        return
    }

    //ヘッダ
    const login_header = {
        "Accept": "application/json",
        "Content-Type": "application/x-www-form-urlencoded"
    }

    //POSTデータ
    const login_data = {
        username: login_id,
        password: login_password,
        api_key: ""
    }

    $.ajax({
        method: "POST",
        url: api_point + "auth/token",
        headers: login_header,
        data: $.param(login_data),
        dataType: "json",
        cache: false
    }).done(function(response){
        alert("ログインを確認しました");
        let AccessToken = response.access_token;
        sessionStorage.setItem("jwt", AccessToken);
        window.location.href = "index.php";
    }).fail(function(jqXHR, textStatus) {
        console.log("Login failed: " + jqXHR.responseText)
        alert("ログインに失敗しました");
    }).always(function(){
        $("#Register").prop("disabled", false);
        $("#Register").text("ログイン");
    });
});