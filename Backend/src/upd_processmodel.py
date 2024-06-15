from pydantic import BaseModel
from typing import Optional

class Process(BaseModel):
    status: bool