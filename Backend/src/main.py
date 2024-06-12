from fastapi import FastAPI, Depends,  HTTPException
from fastapi.middleware.cors import CORSMiddleware
from sqlalchemy.orm import Session, sessionmaker
from sqlalchemy.orm.exc import NoResultFound, MultipleResultsFound

from connect_db import engine, get_db
from kadai_model import Kadai

app = FastAPI()

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
@app.get("/")
def read_root():
  return {"Hello": "World"}

@app.get("/kadai/get/")
async def kadai_getall(db: Session=Depends(get_db)):
  kadai = db.query(Kadai).all()
  return kadai

@app.get("/kadai/get/{id}")
async def kadai_get_id(id, db: Session=Depends(get_db)):

  kadai = db.query(Kadai).filter(Kadai.id == id).all()
  if kadai == []:
    raise HTTPException(status_code=404, detail="Kadai not found")
  else:
    return kadai