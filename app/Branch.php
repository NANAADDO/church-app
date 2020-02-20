<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use OwenIt\Auditing\Contracts\Auditable;
class Branch extends Model implements Auditable{

   use \OwenIt\Auditing\Auditable;

    use SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'branches';

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

    protected $fillable = ['name', 'location', 'region_id', 'country_id', 'address', 'phone_numbers','branch_code','branch_size','branch_id'];

     protected $auditInclude = ['name', 'location', 'region_id', 'country_id', 'address', 'phone_numbers','branch_code','branch_size','branch_id'];

    public function Region(){


        return $this->belongsTo('App\Region','region_id','id');

    }

    public function Country(){


        return $this->belongsTo('App\Countries','country_id','id');

    }
}
