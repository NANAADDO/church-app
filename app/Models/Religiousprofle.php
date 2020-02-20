<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use OwenIt\Auditing\Contracts\Auditable;
class Religiousprofle extends Model implements Auditable{

   use \OwenIt\Auditing\Auditable;

    use SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'religiousprofiles';

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
    protected $fillable = ['are_you_baptised', 'baptism_place', 'baptism_date', 'baptism_rev_minister', 'confirmation_place', 'confirmation_date', 'confirmation_rev_minister', 'are_you_a_communicant', 'reason_why_not_a_communicant', 'are_you_a_convert', 'member_id', 'prev_religious_denomination', 'date_converted', 'convert_rev_minister','have_you_been_confirm'];

     protected $auditInclude = ['are_you_baptised', 'baptism_place', 'baptism_date', 'baptism_rev_minister', 'confirmation_place', 'confirmation_date', 'confirmation_rev_minister', 'are_you_a_communicant', 'reason_why_not_a_communicant', 'are_you_a_convert', 'member_id', 'prev_religious_denomination', 'date_converted', 'convert_rev_minister','have_you_been_confirm'];

    
}
