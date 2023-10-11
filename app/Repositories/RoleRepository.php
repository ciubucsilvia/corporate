<?php

namespace App\Repositories;

use Spatie\Permission\Models\Role as Model;

class RoleRepository extends CoreRepository
{
    protected function getModelClass()
    {
        return Model::class;
    }

    public function getRoles()
    {
        $attributes = new \stdClass;
        $attributes->perPage = config('settings.paginate');
        $attributes->columns = [
            'id', 
            'name'
        ];

        return $this->getItems($attributes);
    }
}
?>