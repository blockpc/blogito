<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Type extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'start', 'end'
    ];

    public function getRouteKeyName()
    {
        return 'key';
    }

    public function setNameAttribute($name)
    {
        $this->attributes['name'] = $name;
        $this->attributes['key'] = Str::slug($name);
    }

    public function block()
    {
        return $this->hasOne(Block::class);
    }
}
