<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class userData extends Model
{
    protected $table="user_data";
    protected $fillable=["name","email","phone","Address"];
    
}
