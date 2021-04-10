<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class SMSBalance extends Model implements Auditable{

   use \OwenIt\Auditing\Auditable;


    protected $table = 'sms_balance';


    protected $primaryKey = 'id';


    protected $fillable = ['balance','branch_id'];

     protected $auditInclude = ['balance','branch_id'];



}
