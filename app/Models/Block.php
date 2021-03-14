<?php

namespace App\Models;

use App\Traits\Incrementable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Block extends Model
{
    use HasFactory, Incrementable;

    protected $fillable = [
        'type_id', 'post_id', 'content', 'legend', 'title', 'position'
    ];

    protected $incrementable = 'position';
    protected $incrementableGroup = ['post_id'];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function type()
    {
        return $this->belongsTo(Type::class);
    }
}
