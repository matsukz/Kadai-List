from sqlalchemy import Column, Integer, BigInteger ,String, Date, Boolean
from pydantic import BaseModel
from typing import Optional

from ..connect_db import Base

#ユーザーに関する情報
class Users(Base):
    __tablename__ = "users"
    id = Column(Integer, primary_key=True, index=True)
    username = Column(String(50), unique=True, index=True)
    password_hash = Column(String(100))
    api_key = Column(String(100), unique=True)

#トークンの管理
class TokenData(BaseModel):
    username: Optional[str] = None

#ユーザー作成に関する情報
class UserCreate(BaseModel):
    username: str
    password: str