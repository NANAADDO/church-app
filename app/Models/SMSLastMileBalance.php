<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class SMSLastMileBalance extends Model implements Auditable{

   use \OwenIt\Auditing\Auditable;


    protected $table = 'sms_history';


    protected $primaryKey = 'id';


    protected $fillable = ['response','is_it_scheduled','user_id','branch_id'];

     protected $auditInclude = ['response','is_it_scheduled','user_id','branch_id'];

    protected $with=['member','message'];



}
