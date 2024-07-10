from pydantic import BaseModel
from datetime import date

class KadaiCreate(BaseModel):
    id: int
    register_date: date
    start_date: date
    limit_date: date
    group: str
    title: str
    content: str
    note: str
    status: bool
    user_id: int