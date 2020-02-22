<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;
class User extends Authenticatable implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use SoftDeletes;

    use Notifiable,HasRoles;


    protected $fillable = [
        'name', 'email', 'password','first_name','phone_number','surname','username','other_names','branch_id'
    ];
    protected $auditInclude = [
        'name', 'email', 'password','first_name','phone_number','surname','username','other_names','branch_id'
    ];

    protected $table = 'users';
    protected $primaryKey = 'id';


    protected $hidden = [
        'password', 'remember_token',
    ];


    protected $casts = [
        'email_verified_at' => 'datetime',
    ];



    public function Userroles(){


            return $this->belongsTo('App\RoleUser','id','user_id');

    }
}


