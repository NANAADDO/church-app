<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use OwenIt\Auditing\Contracts\Auditable;
class Churchcustompayment extends Model implements Auditable{

   use \OwenIt\Auditing\Auditable;

    use SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'churchcustompayments';

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
    protected $fillable = ['amount', 'year', 'start_date', 'collection_id', 'end_date'];

     protected $auditInclude = ['amount', 'year', 'start_date', 'collection_id', 'end_date'];

     public function giventypes(){

        return $this->belongsTo('App\Churchgiven','collection_id','id');
    }
    
}
