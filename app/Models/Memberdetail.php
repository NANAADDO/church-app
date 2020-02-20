<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Memberdetail extends Model implements Auditable{

   use \OwenIt\Auditing\Auditable;

    use SoftDeletes;

    protected $table = 'memberdetails';


    protected $primaryKey = 'id';


    protected $fillable = ['surname', 'other_names', 'birth_place', 'old_member_id', 'new_member_id', 'branch_id', 'date_of_birth', 'nationality_id', 'title_id', 'hometown_id', 'address', 'house_number', 'street_name', 'locality_id', 'gender_id', 'phone_numbers','profession_id', 'email','img_path','are_you_a_literate','are_you_employed',
        'does_member_have_kids','does_member_have_relation_in_accra','date_joined','marital_status_id',
        'is_member_part_of_church_groups','does_member_want_to_join_welfare','date_joined_welfare','does_member_have_any_emergency_contact',
        'id_type_id','id_number','does_member_have_identification_id','status_id'];

     protected $auditInclude = ['surname', 'other_names', 'birth_place', 'old_member_id', 'new_member_id', 'branch_id', 'date_of_birth', 'nationality_id', 'title_id', 'hometown_id', 'address', 'house_number', 'street_name', 'locality_id', 'gender_id','profession_id', 'phone_numbers', 'email','img_path','img_path','are_you_a_literate','are_you_employed',
         'does_member_have_kids','does_member_have_relation_in_accra','date_joined','marital_status_id','is_member_part_of_church_groups','does_member_want_to_join_welfare','date_joined_welfare',
         'does_member_have_any_emergency_contact','id_type_id','id_number','does_member_have_identification_id','status_id'];

    protected $with=['kids','spouse','Education','religious','marital','groups','Emergency','idtype','Employment'];


    public function idtype(){

        return $this->belongsTo('App\Models\IDTypes','id_type_id','id');
    }

    public function gender(){

        return $this->belongsTo('App\Gender','gender_id','id');
    }


    public function groups(){

        return $this->hasMany('App\Models\Memberchurchgroups','member_id');
    }


    public function locality(){

        return $this->belongsTo('App\Locality','locality_id','id');
    }

    public function marital(){

        return $this->belongsTo('App\Maritalstatus','marital_status_id','id');
    }



    public function country(){

        return $this->belongsTo('App\Countries','nationality_id','id');
    }

    public function hometown(){

        return $this->belongsTo('App\Hometown','hometown_id','id');
    }
    public function religious(){

        return $this->belongsTo('App\Models\Religiousprofle','id','member_id');
    }

    public function Education(){

        return $this->belongsTo('App\Models\Education','id','member_id');

    }

    public function Employment(){

        return $this->belongsTo('App\Models\Employment','id','member_id');

    }

    public function Family(){

        return $this->hasMany('App\Models\Familymember','member_id');

    }

    public function kids(){

        return $this->Family()->where('type','=',1);
    }

    public function relatives(){

        return $this->Family()->where('type','=',2);
    }

    public function spouse(){

        return $this->Family()->where('type','=',3);
    }
    public function Emergency(){

        return $this->Family()->where('type','=',4);
    }


}
