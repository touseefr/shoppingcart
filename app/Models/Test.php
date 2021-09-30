<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    use HasFactory;

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = json_encode($value);
    }
}
