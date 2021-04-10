<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class GeneralSmartMessages extends Model implements Auditable{

   use \OwenIt\Auditing\Auditable;


    protected $table = 'sms_history';


    protected $primaryKey = 'id';


    protected $fillable = ['message_id','tag_name','phone_number','member_id','sms_delivery_state','is_it_scheduled','date_scheduled','user_id','branch_id'];

     protected $auditInclude = ['message_id','tag_name','phone_number','member_id','sms_delivery_state','is_it_scheduled','date_scheduled','user_id','branch_id'];

    protected $with=['member','message'];

    public function message(){

        return $this->belongsTo('App\Models\TextMessage','message_id','id');
    }

    public function member(){

        return $this->belongsTo('App\Models\Memberdetails','member_id','id');
    }

}
