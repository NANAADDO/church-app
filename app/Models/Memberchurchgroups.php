<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use OwenIt\Auditing\Contracts\Auditable;
class Memberchurchgroups extends Model implements Auditable{

   use \OwenIt\Auditing\Auditable;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'memberchurchgroups';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name','member_id','groups_id'];

     protected $auditInclude = ['name','member_id','groups_id'];

    protected $with=['groupname'];


    public function groupname(){

        return $this->belongsTo('App\Churchgroup','groups_id','id');
    }

}
