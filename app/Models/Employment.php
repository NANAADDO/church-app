<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use OwenIt\Auditing\Contracts\Auditable;
class Employment extends Model implements Auditable{

   use \OwenIt\Auditing\Auditable;

    use SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'employments';

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




    protected $fillable = ['profession_id', 'name', 'phone_number', 'address', 'member_id'];

     protected $auditInclude = ['profession_id', 'name', 'phone_number', 'address', 'member_id'];

    protected $with=['profession'];

    public function profession(){

        return $this->belongsTo('App\Profession','profession_id','id');
    }
}
