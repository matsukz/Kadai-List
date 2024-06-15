from fastapi import FastAPI, Depends,  HTTPException
from fastapi.middleware.cors import CORSMiddleware
from sqlalchemy.orm import Session, sessionmaker
from sqlalchemy.orm.exc import NoResultFound, MultipleResultsFound

from connect_db import engine, get_db
from kadai_model import Kadai
from createkadai_model import KadaiCreate
from upd_processmodel import Process

from datetime import datetime

description = """
  MySQLと連携してタスク管理をするAPIです。\n
  FastAPIの練習も兼ねて作りました。RESTっぽくなってると思います。\n
  Githubのリポジトリは[こちら](https://github.com/matsukz/Kadai-List)
  """

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

@app.get("/api/kadai/", tags=["APIエンドポイント"], summary="すべての課題を取得します")
async def kadai_getall(db: Session=Depends(get_db)):
  kadai = db.query(Kadai).all()
  return kadai

@app.get("/api/kadai/{id}", tags=["APIエンドポイント"], summary="IDに応じた課題を取得します")
async def kadai_get_id(id, db: Session=Depends(get_db)):

  kadai = db.query(Kadai).filter(Kadai.id == id).all()
  if kadai == []:
    raise HTTPException(status_code=404, detail="Kadai not found")
  else:
    return kadai

@app.post("/api/kadai/", response_model=KadaiCreate, tags=["APIエンドポイント"], summary="課題を新規作成します")
async def kadai_create(newkadai: KadaiCreate, db: Session=Depends(get_db)):
  """日付は YYYY-MM-DDの形です!"""
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
    status = newkadai.status
  )

  db.add(create_kadai) #DB追加
  db.commit() #確定
  db.refresh(create_kadai) #再読み込み
  return create_kadai

@app.put("/api/kadai/{id}", response_model=KadaiCreate,tags=["APIエンドポイント"], summary="IDに応じた課題を編集します")
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
  kadai_upd.status = kadai.status

  db.commit()
  db.refresh(kadai_upd)
  return kadai_upd

@app.put("/api/kadai/process/", response_model=Process, tags=["APIエンドポイント"], summary="IDに応じた課題の完了フラグを変える")
async def kadai_process_update(kadai:Process, db: Session=Depends(get_db)):

  kadai_upd_pros = db.query(Kadai).filter(Kadai.id == kadai.id).first()

  if kadai_upd_pros is None:
    raise HTTPException(status_code=404, detail="Kadai not found")
  
  kadai_upd_pros.status = kadai.status

  db.commit()
  db.refresh(kadai_upd_pros)
  return kadai_upd_pros

@app.delete("/api/kadai/{id}", response_model=dict, tags=["APIエンドポイント"], summary="IDに応じた課題を削除します")
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