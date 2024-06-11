from sqlalchemy import Column, Integer, String
from connect_db import Base

class Kadai(Base):
    __tablename__ = "kadai"
    id 