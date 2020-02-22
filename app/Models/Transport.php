<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use OwenIt\Auditing\Contracts\Auditable;
class Transport extends Model implements Auditable{

   use \OwenIt\Auditing\Auditable;

    use SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'transports';

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
    protected $fillable = ['amount', 'expected_amount', 'expected_people', 'user_id', 'member_id', 'date', 'funeral_date', 'txt_state_id', 'description'];

     protected $auditInclude = ['amount', 'expected_amount', 'expected_people', 'user_id', 'member_id', 'date', 'funeral_date', 'txt_state_id', 'description'];

protected $with=['member'];


    public function member(){

        return $this->belongsTo('App\Models\Memberdetail','member_id','id');
    }



    
}
