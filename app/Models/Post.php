<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use function Symfony\Component\Translation\t;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'content',
        'img',
        'privacy_id',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function privacy(){
        return $this->belongsTo(Privacy::class);
    }

    public function likedBy(){
        return $this->belongsToMany(User::class);
    }

}
