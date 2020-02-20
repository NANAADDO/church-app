<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use OwenIt\Auditing\Contracts\Auditable;
class Questionoption extends Model implements Auditable{

   use \OwenIt\Auditing\Auditable;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'question_option';

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
    protected $fillable = ['name'];

     protected $auditInclude = ['name'];

    
}
