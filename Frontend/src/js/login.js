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

    //POSTデータ
    const login_data = {
        username: login_id,
        password: login_password,
        api_key: ""
    }

    $.ajax({
        method: "POST",
        url: "login_script.php",
        data: $.param(login_data),
        contentType: "application/x-www-form-urlencoded; charset=UTF-8",
        dataType: "text",
        cache: false
    }).done(function(response){
        alert("ログインを確認しました");
    }).fail(function(jqXHR, textStatus, errorThrown) {
        var console_msg = "";
        var login_alert = "";
        switch (jqXHR.status) {
            case 401:
                console_msg = "Unauthorized(401)";
                login_alert = "IDまたはパスワードが違います";
                break;
            case 503:
                console_msg = "Internal Server Error(500)";
                login_alert = "ログインサーバーにアクセスできません";
                break;
            default:
                console_msg = "Other Errors";
                login_alert = "不明なエラーが発生しました " + jqXHR.status;
                break;
        }
        console.log("Login: " + console_msg);
        alert(login_alert);
    }).always(function(){
        $("#Register").prop("disabled", false);
        $("#Register").text("ログイン");
    });
});