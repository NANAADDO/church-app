<?php

namespace App\Repositories\Eloquent;
use App\Repositories\BaseRepository;

use App\Repositories\Contracts\CallcenterRepository;

use App\Repositories\RepositoryContract;
use App\User;
use Illuminate\Support\Facades\DB;
use Kurt\Repoist\Repositories\Eloquent\AbstractRepository;

class EloquentGeneralAuthenticateRepository extends BaseRepository implements RepositoryContract
{

    public function model()
    {
        return User::class;
    }
    public function updateById($id, array $data, array $options = [])
    {

        $data['password'] = bcrypt($data['password']);
        return DB::transaction(function () use ($id, $data,$options) {

            $model = $this->getByColumn($id, 'id');
            $model->update($data, $options);
            return $model;
        });
    }


}
