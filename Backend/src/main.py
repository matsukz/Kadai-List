from fastapi import FastAPI, Depends,  HTTPException, Header, Form
from fastapi.middleware.cors import CORSMiddleware
from fastapi.security import OAuth2PasswordBearer, OAuth2PasswordRequestForm
from sqlalchemy.orm import Session, sessionmaker
from sqlalchemy.orm.exc import NoResultFound, MultipleResultsFound
from typing import Optional

from connect_db import engine, get_db
from kadai_model import Kadai
from createkadai_model import KadaiCreate
from upd_processmodel import Process

from auth.auth import create_user,authenticate_user,create_access_token
from auth.auth import authenticate_user, get_user, verify_password
from auth.auth import get_current_user, get_current_user_api_key
from auth.auth import ACCESS_TOKEN_EXPIRE_MINUTES,oauth2_scheme

from auth.user_model import Users, UserCreate

from datetime import datetime, timedelta

description = """
  MySQLと連携してタスク管理をするAPIです。\n
  FastAPIの練習も兼ねて作りました。RESTっぽくなってると思います。\n
  Githubのリポジトリは[こちら](https://github.com/matsukz/Kadai-List)
  """

tags_kadai:str ; tags_kadai = "課題API"
tags_auth:str ; tags_auth = "ユーザー認証API"

app = FastAPI(
  title = "課題管理API - FastAPI",
  description=description
)

#CORSエラー対策
app.add_middleware(
    CORSMiddleware,
    allow_origins=["*"],
    allow_credentials=True,   # 追記により追加
    allow_methods=["*"],      # 追記により追加
    allow_headers=["*"]       # 追記により追加
)

#起動時
@app.on_event("startup")
async def startup():
  pass

#終了時
@app.on_event("shutdown")
async def shutdown():
  pass

@app.get("/kadai/api/", tags=[tags_kadai], summary="すべての課題を取得します")
async def kadai_getall(db: Session=Depends(get_db)):
  kadai = db.query(Kadai).all()
  return kadai

@app.get("/kadai/api/filter", tags=[tags_kadai], summary="提出状況で絞り込みます")
async def kadai_getfilter(status: bool, db: Session=Depends(get_db)):
  kadai_status:bool ; kadai_status = status
  kadai = db.query(Kadai).filter(Kadai.status == kadai_status).all()
  if kadai == []:
    raise HTTPException(status_code=404, detail="Kadai not found")
  else:
    return kadai

@app.get("/kadai/api/{id}", tags=[tags_kadai], summary="IDに応じた課題を取得します")
async def kadai_get_id(id, db: Session=Depends(get_db)):

  kadai = db.query(Kadai).filter(Kadai.id == id).all()
  if kadai == []:
    raise HTTPException(status_code=404, detail="Kadai not found")
  else:
    return kadai

@app.post("/kadai/api/", response_model=KadaiCreate, tags=[tags_kadai], summary="課題を新規作成します")
async def kadai_create(newkadai: KadaiCreate, db: Session=Depends(get_db)):
  """日付は YYYY-MM-DDの形です!"""

  if newkadai.limit_date < newkadai.start_date:
    raise HTTPException(status_code=400, detail="Is the date setting accurate?")
  
  #kadai_model参照
  create_kadai = Kadai(
    #idはオートインクリメント
    register_date = newkadai.register_date,
    start_date = newkadai.start_date,
    limit_date = newkadai.limit_date,
    group = newkadai.group,
    title = newkadai.title,
    content = newkadai.content,
    note = newkadai.note,
    status = newkadai.status,
    user_id = newkadai.user_id
  )

  db.add(create_kadai) #DB追加
  db.commit() #確定
  db.refresh(create_kadai) #再読み込み
  return create_kadai

@app.put("/kadai/api/{id}", response_model=KadaiCreate,tags=[tags_kadai], summary="IDに応じた課題を編集します")
async def kadai_update(id: int, kadai:KadaiCreate, db: Session=Depends(get_db)):

  kadai_upd = db.query(Kadai).filter(Kadai.id == id).first()

  if kadai_upd is None:
    raise HTTPException(status_code=404, detail="Kadai not found")
  
  kadai_upd.register_date = kadai.register_date,
  kadai_upd.start_date = kadai.start_date,
  kadai_upd.limit_date = kadai.limit_date,
  kadai_upd.group = kadai.group,
  kadai_upd.title = kadai.title,
  kadai_upd.content = kadai.content,
  kadai_upd.note = kadai.note,
  kadai_upd.status = kadai.status,
  kadai_upd.user_id = kadai.user_id

  db.commit()
  db.refresh(kadai_upd)
  return kadai_upd

@app.put("/kadai/api/process/{id}", response_model=Process, tags=[tags_kadai], summary="IDに応じた課題の完了フラグを変える")
async def kadai_process_update(id: int, kadai:Process, db: Session=Depends(get_db)):

  kadai_upd_pros = db.query(Kadai).filter(Kadai.id == id).first()

  if kadai_upd_pros is None:
    raise HTTPException(status_code=404, detail="Kadai not found")
  
  kadai_upd_pros.status = kadai.status

  db.commit()
  db.refresh(kadai_upd_pros)
  return kadai_upd_pros

@app.delete("/kadai/api/{id}", response_model=dict, tags=[tags_kadai], summary="IDに応じた課題を削除します")
def kadai_delete(id: int, db: Session=Depends(get_db)):

  kadai_del = db.query(Kadai).filter(Kadai.id == id).first()

  if kadai_del is None:
    raise HTTPException(status_code=404, detail="Kadai not found")

  #削除
  db.delete(kadai_del)
  #確定
  db.commit()
  msg = f"User:{id} deleted successfully"
  return {"message": msg}


@app.get("/kadai/api/auth/", tags=[tags_auth], summary="認証テストです")
async def check_auth_root(current_user: Users = Depends(get_current_user)):
  return {"user_id": current_user.user_id, "user_name": current_user.username}

@app.post("/kadai/api/auth/token/keys/", response_model=dict, tags=[tags_auth], summary="APIキーでトークンを発行します")
async def login_token_api_key(api_key: str, db: Session=Depends(get_db)):
  user = db.query(Users).filter(Users.api_key == api_key).first()
  if not user:
    raise HTTPException(
      status_code = 401,
      detail = "Invalid API Key"
    )
  
  access_token_expires = timedelta(minutes=ACCESS_TOKEN_EXPIRE_MINUTES)
  access_token = create_access_token(
    data={"sub": user.username},
    expires_delta=access_token_expires
  )
  return {"access_token": access_token, "token_type": "bearer"}

@app.post("/kadai/api/auth/register/", response_model=dict, tags=[tags_auth], summary="ユーザーを作成するAPIです")
async def register_user(user: UserCreate, db: Session=Depends(get_db)):

  db_user = db.query(Users).filter(Users.username == user.username).first()
  if db_user:
    raise HTTPException(status_code=400, detail="Username already registered")
  
  user = create_user(user,db)
  return {"username": user.username, "api_key": user.api_key}

@app.post("/kadai/api/auth/token/idpw/", response_model=dict, tags=[tags_auth], summary="ID/PWでトークンを発行します")
async def login_for_access_token(form_data: OAuth2PasswordRequestForm = Depends(), db: Session=Depends(get_db)):
  user = authenticate_user(form_data.username, form_data.password, db)
  if not user:
    raise HTTPException(
      status_code = 401,
      detail="Incorrect username or password",
      headers={"WWW-Authenticate": "Bearer"}
    )
  access_token_expires = timedelta(minutes=ACCESS_TOKEN_EXPIRE_MINUTES)
  access_token = create_access_token(
    data={"sub":user.username},
    expires_delta=access_token_expires
  )

  return {"access_token": access_token, "token_type": "bearer"}

@app.post("/kadai/api/auth/token", response_model=dict, tags=[tags_auth], summary="トークンを発行します")
async def access_token_unification(
  username: Optional[str] = Form(None),
  password: Optional[str] = Form(None),
  api_key: Optional[str] = Form(None),
  db: Session = Depends(get_db)
):
  user = None
  if username and password:
    user = authenticate_user(username, password, db)
  elif api_key:
    user = get_current_user_api_key(api_key, db)
  else:
    raise HTTPException(
      status_code=400,
      detail="Must include either username/password or API key",
    )
  
  if not user:
    raise HTTPException(
      status_code=401,
      detail="Incorrect username/password or invalid API key",
      headers={"WWW-Authenticate": "Bearer"}
    )
  
  access_token_expires = timedelta(minutes=ACCESS_TOKEN_EXPIRE_MINUTES)
  access_token = create_access_token(
      data={"sub": user.username}, expires_delta=access_token_expires
  )
  return {"access_token": access_token, "token_type": "bearer"}