<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;
class Invoke_revoke_permissions extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;


    protected $fillable = [
        'permission_id', 'action_type', 'user_id'
    ];
    protected $auditInclude = [
        'permission_id', 'action_type', 'user_id'
    ];

    protected $table = 'revoke_invoke_permissions';
    protected $primaryKey = 'id';
}
