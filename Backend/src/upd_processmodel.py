from pydantic import BaseModel
from typing import Optional

class Process(BaseModel):
    id: int
    status: bool