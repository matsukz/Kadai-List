from fastapi import Depends
from fastapi.security import OAuth2PasswordBearer, OAuth2PasswordRequestForm
from jose import JWTError, jwt
from passlib.context import CryptContext
from sqlalchemy.orm import Session, sessionmaker
import secrets

import os
from dotenv import load_dotenv
from datetime import datetime

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