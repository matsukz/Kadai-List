from sqlalchemy import Column, Integer, BigInteger ,String, Date, Boolean
from connect_db import Base

class Kadai(Base):
    __tablename__ = "kadai"
    id = Column(BigInteger, primary_key=True, index=True)
    register_date = Column(Date)
    start_date = Column(Date)
    limit_date = Column(Date)
    group = Column(String(length=100, collation='utf8mb3_general_ci'))
    title = Column(String(length=100, collation='utf8mb3_general_ci'))
    content = Column(String(length=100, collation='utf8mb3_general_ci'))
    note = Column(String(length=100, collation='utf8mb3_general_ci'))
    status = Column(Boolean)
    