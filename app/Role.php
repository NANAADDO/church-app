<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use OwenIt\Auditing\Contracts\Auditable;

class Role extends Model implements Auditable{

    use \OwenIt\Auditing\Auditable;



    protected $fillable = ['name', 'label'];

    protected $auditInclude = ['name', 'label'];


    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }


    public function givePermissionTo(Permission $permission)
    {
        return $this->permissions()->save($permission);
    }



}
