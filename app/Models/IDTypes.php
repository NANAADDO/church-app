<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class IDTypes extends Model implements Auditable{

   use \OwenIt\Auditing\Auditable;


    protected $table = 'identificationtypes';


    protected $primaryKey = 'id';


    protected $fillable = ['name'];

     protected $auditInclude = ['name'];

    protected $with=[];

}
