# 課題とFASTAPI

## 使い方
1. 次のファイルの名前から`.exp`を削除する
    * [environment.js.exp](./Frontend/src/js/environment.js)
    * [frontrnd.env](./Frontend/frontend.env)
    * Python用の[.env](./Backend/src/auth/.env.exp)
    * Cloudflare用の[.env](./cloudflared/.env.exp)

2. 次のファイルに必要な共通変数をセットする
    * [environment.js](./Frontend/src/js/environment.js)
    * [frontrnd.env](./Frontend/frontend.env)

3. パスワード発行鍵を生成してPython用の[.env](./Backend/src/auth/.env.exp)にセット
    ```python
    import secrets
    # 32バイトの安全なランダムシークレットキーを生成
    secret_key = secrets.token_hex(32)
    print(secret_key)
    ```

    * [.env](./Backend/src/auth/.env.exp)の内容
    ```env
    SECRET_KEY=生成した鍵
    ```
4. Cloudflaredの有効化
    * Cloudflare用の[.env](./cloudflared/.env.exp)にTunnelトークンをセット

## 認証の流れ
認証セッションにはトークンが必要です。
フロントエンド側で取得してください。

* APIキーも利用可能です。
    * PythonのRequestでやる場合
        ```python
        import requests

        api_key = ""

        #===トークン取得===
        create_token = requests.post(
            "http://127.0.0.1:9004/kadai/api/auth/token",
            headers={"Content-Type": "application/x-www-form-urlencoded"},
            data={"api_key":api_key}
        )

        create_json = create_token.json()
        token = create_json["access_token"]
        #================

        #tokenをヘッダにセットしてAPIエンドポイントへリクエスト
        get_query = requests.get(
            "http://127.0.0.1/kadai/api/",
            headers={"Authorization": f"Bearer {token}"}
        )
        #===============
        print(get_query.text)
    * 適宜cURLに置き換えてもダイジョブです
        