<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use OwenIt\Auditing\Contracts\Auditable;
class Churchgiven extends Model implements Auditable{

   use \OwenIt\Auditing\Auditable;

    use SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'churchgivens';

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
    protected $fillable = ['name', 'description','groups_id','payment_types_id'];

     protected $auditInclude = ['name', 'description','groups_id','payment_types_id'];

    public function relatives(){

        return $this->Family()->where('type','=',2);
    }

    public function spouse(){

        return $this->Family()->where('type','=',3);
    }
    
}
