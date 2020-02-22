<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use OwenIt\Auditing\Contracts\Auditable;
class Months extends Model implements Auditable{

    use \OwenIt\Auditing\Auditable;


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'months';

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
    protected $fillable = ['ident', 'name'];

    protected $auditInclude = [ 'ident', 'name'];


    protected $with=[];




}
