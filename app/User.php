<?php

namespace App;

use App\Events\Event;
use App\Events\UserRegistered;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email','password','avatar','confirm_code','is_confirmed'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function register(array $attributes){
        $user=static::create($attributes);
        event(new UserRegistered($user));
        return $user;
    }

    public function setPasswordAttribute($password){
        $this->attributes['password']=\Hash::make($password);
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function discussion(){
        return $this->hasMany(Discussion::class);//$user->discussion;
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public function favourites(){
        return $this->belongsToMany(Lesson::class,'favourites')->withTimestamps();
    }

}
