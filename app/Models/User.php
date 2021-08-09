<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Session;
use Auth;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'users';
    protected $fillable = ['name', 'email', 'password', 'phone', 'role_id', 'user_id', 'password', 'status', 'current_status'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role(){
        return $this->belongsTo('App\Models\Role');
    }

    public static function logout()
    {
        $status = Auth::user()->current_status;
        Session::flush();
        Auth::logout();
        return back()->with(['message'=>$status=="normal"?"Sorry! You are not approved yet.":"Sorry! You are suspended."]);
    }

    public function branch(){
        return $this->belongsTo('Modules\Branch\Entities\Branch');
    }

    public static function CheckUserStatus(){
        if(auth()->user()->current_status =="normal" || auth()->user()->current_status =="suspended")
        {
            static::logout();
        }
    }
}
