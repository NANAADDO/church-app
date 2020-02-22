<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use OwenIt\Auditing\Contracts\Auditable;
class Membercustompayment extends Model implements Auditable{

   use \OwenIt\Auditing\Auditable;

    use SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'membercustompayments';

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
    protected $fillable = ['amount', 'year', 'amount_paid', 'collection_id', 'member_id','user_id'];

     protected $auditInclude = ['amount', 'year', 'amount_paid', 'collection_id', 'member_id','user_id'];

    public function giventypes(){

        return $this->belongsTo('App\Churchgiven','collection_id','id');
    }

    public function member(){

        return $this->belongsTo('App\Models\Memberdetail','member_id','id');

    }
}
