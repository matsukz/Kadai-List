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

    

})