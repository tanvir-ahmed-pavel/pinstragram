<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();
        static::created(function ($user){
//            $fpath = 'storage/'.$user->id.$user->user_name.'.png';
//            $path = $user->id.$user->user_name.'.png';
//            Avatar::create($user->user_name)->save($fpath);
            $user->profile()->create([
//                "profile_img" => $path,
                "title" => "i am " . $user->name,
            ]);
        });
    }

    public function posts(){
        return $this->hasMany(Post::class);
    }

    public function profile(){
        return $this->hasOne(Profile::class);
    }

}
