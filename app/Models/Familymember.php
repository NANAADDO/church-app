<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use OwenIt\Auditing\Contracts\Auditable;
class Familymember extends Model implements Auditable{

   use \OwenIt\Auditing\Auditable;

    use SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'familymembers';

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
    protected $fillable = ['name', 'address', 'phone_number', 'relationship_id', 'marital_status_id', 'marriage_type_id', 'marriage_place', 'date', 'rev_minister', 'church_id', 'member_id', 'office', 'residence', 'locality_id','type'];

     protected $auditInclude = ['name', 'address', 'phone_number', 'relationship_id', 'marital_status_id', 'marriage_type_id', 'marriage_place', 'date', 'rev_minister', 'church_id', 'member_id', 'office', 'residence', 'locality_id','type'];
    protected $with = ['relationship','locality','marriagetype'];


    public function marriagetype(){

        return $this->belongsTo('App\Marriagetype','marriage_type_id','id');
    }

    public function relationship(){

        return $this->belongsTo('App\Relationship','relationship_id','id');
    }

    public function locality(){

        return $this->belongsTo('App\Locality','locality_id','id');
    }
    
}
