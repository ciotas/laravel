<?php

namespace App;

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
        'name', 'email','password'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function setPasswordAttribute($password){
        $this->attributes['password']=\Hash::make($password);
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function discussion(){
        return $this->hasMany(Discussion::class);//$user->discussion;
    }
}
