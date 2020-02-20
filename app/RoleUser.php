<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use OwenIt\Auditing\Contracts\Auditable;
class RoleUser extends Model implements Auditable{

   use \OwenIt\Auditing\Auditable;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'role_user';

    /**
    * The database primary key value.
    *
    * @var string
    */


    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['role_id', 'user_id'];

     protected $auditInclude = ['role_id', 'user_id'];

    protected $with=['role'];


    public function role(){

        return $this->belongsTo('App\Role','role_id','id');
    }
    
}
