from fastapi import Depends
from fastapi.security import OAuth2PasswordBearer, OAuth2PasswordRequestForm
from jose import JWTError, jwt
from passlib.context import CryptContext
from sqlalchemy.orm import Session, sessionmaker
import secrets
from typing import Optional

import os
from dotenv import load_dotenv
from datetime import datetime, timedelta, timezone

from auth.user_model import Users, UserCreate
from connect_db import get_db

load_dotenv()

# シークレットキーとアルゴリズムを設定
SECRET_KEY = os.getenv("SECRET_KEY")
ALGORITHM = "HS256"
ACCESS_TOKEN_EXPIRE_MINUTES = 30

if SECRET_KEY is None:
    raise ValueError("SECRET_KEY is not set in the environment variables")

# パスワードハッシュの設定
pwd_context = CryptContext(schemes=["bcrypt"], deprecated="auto")

# OAuth2の設定
oauth2_scheme = OAuth2PasswordBearer(tokenUrl="token")

def create_user(user: UserCreate, db: Session=Depends(get_db)):
    hashed_password = pwd_context.hash(user.password)
    api_key = secrets.token_hex(32)
    db_user = Users(
        username=user.username,
        password_hash=hashed_password,
        api_key=api_key
    )
    db.add(db_user)
    db.commit()
    db.refresh(db_user)
    return db_user

def create_access_token(data: dict, expires_delta: Optional[timedelta] = None):
    to_encode = dict.copy()
    if expires_delta:
        expires = datetime.now(datetime.utc)  + expires_delta
    else:
        expires = datetime.now(timezone.utc) + timedelta(minutes=15)
    
    to_encode.update({"exp":expires})
    encode_jwt = jwt.encode(to_encode, SECRET_KEY, algorithm=ALGORITHM)
    return encode_jwt

def authenticate_user(username:str, password:str, db: Session=Depends(get_db)):
    user = get_user(username, db)
    if not user:
        return False
    if not verify_password(password, user.password_hash):
        return False
    return user


def get_user(username:str, db: Session=Depends(get_db)):
    return db.query(Users).filter(Users.username == username).first()

def verify_password(plain_password, hashed_password):
    return pwd_context.verify(plain_password, hashed_password)