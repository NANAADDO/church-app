<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use OwenIt\Auditing\Contracts\Auditable;
class Parent_module extends Model implements Auditable
{

    use \OwenIt\Auditing\Auditable;

    use SoftDeletes;

    protected $primaryKey = 'id';


    protected $fillable = ['name','group_type_id','path_name','aliases'];

    protected $auditInclude = ['name','group_type_id','path_name','	aliases'];


    protected $table = 'parent_module';

    protected $with = ['granted'];

    public function granted(){

        return $this->hasMany('App\Permission','id','parent_id');
    }


}
