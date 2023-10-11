<?php

namespace App\Repositories;

use Spatie\Permission\Models\Permission as Model;

class PermissionRepository extends CoreRepository
{
    protected function getModelClass()
    {
        return Model::class;
    }

    public function getPermissions()
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