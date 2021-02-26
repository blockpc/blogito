<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FailedJob extends Model
{
    public function getExceptionAttribute($value)
    {
        $strings = explode("\n", $value);
        return $strings[0];
    }
}
