<?php

namespace App\Repositories;

use App\Models\User as Model;

class UserRepository extends CoreRepository
{
    protected function getModelClass()
    {
        return Model::class;
    }

    public function getUsers()
    {
        $attributes = new \stdClass;
        $attributes->perPage = config('settings.paginate');
        $attributes->columns = [
            'id', 
            'name',
            'email'
        ];

        return $this->getItems($attributes);
    }
}
?>