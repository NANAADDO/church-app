<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use OwenIt\Auditing\Contracts\Auditable;
class payment_history extends Model implements Auditable{

   use \OwenIt\Auditing\Auditable;

    use SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'payment_histories';

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
    protected $fillable = ['amount_paid', 'user_id', 'member_id', 'date_paid','year', 'month_paid','collection_id', 'point_id', 'point_sub_id',
        'receipt_id','related_payment','payment_state','comment','reversed_by'];

     protected $auditInclude = ['amount_paid', 'user_id', 'member_id', 'date_paid','year','month_paid', 'collection_id', 'point_id', 'point_sub_id',
         'receipt_id','related_payment','payment_state','comment','reversed_by'];


    protected $with=['member','collection','point','months','revuser'];


    public function revuser(){

        return $this->belongsTo('App\User','reversed_by','id');
    }

    public function member(){

        return $this->belongsTo('App\Models\Memberdetail','member_id','id');
    }

    public function collection(){

        return $this->belongsTo('App\Churchgiven','collection_id','id');
    }

    public function point(){

        return $this->belongsTo('App\Models\Paymentpoint','point_id','id');
    }

    public function months(){

        return $this->belongsTo('App\Models\Months','month_paid','id');
    }

}
