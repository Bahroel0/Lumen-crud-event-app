<?php

namespace App;

use App\UserRole;
use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;

class User extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable;

    protected $table    = 'users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'password', 'api_token', 'role_id'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    public static $validation_roles = [
        'email' => 'required|unique:users',
        'password' => 'required',
        'role_id' => 'required',
        'api_token' => 'required'
    ];

    public function role(){
        return $this->belongsTo(UserRole::class, 'role_id', 'id');
    }

    public function event_user(){
        return $this->hasMany(EventUser::class, 'user_id');
    }

    public static function boot(){
        parent::boot();

        static::deleting(
            function($user){
                $user->event_user()->delete();
            }
        );
    }
}
