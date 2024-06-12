# 課題とFASTAPI

# 新規作成API
```bash
    curl -X 'POST' \
    'http://localhost:9004/kadai/create/' \
    -H 'accept: application/json' \
    -H 'Content-Type: application/json' \
    -d '{
    "register_date": "2024-06-12",
    "start_date": "2024-06-08",
    "limit_date": "2024-06-10",
    "group": "インターンシップ準備講座",
    "title": "第10回提出",
    "content": "授業のまとめを提出する",
    "note": "17時まで",
    "status": 0
    }'
```