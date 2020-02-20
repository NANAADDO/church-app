<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{

    /**vh
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'parent_id','event_id'];
    protected $table = 'permissions';
    /**
     * A permission can be applied to roles.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    /**
     * Change activity log event description
     *
     * @param string $eventName
     *
     * @return string
     */
    protected $with = ['module'];


    public function module(){

        return $this->belongsTo('App\Models\Parent_module','parent_id','id');
    }

    public function modeled(){

        return $this->belongsTo('App\Permission');
    }





}
