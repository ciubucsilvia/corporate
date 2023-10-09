<?php

namespace App\Repositories;

use Spatie\Permission\Models\Permission as Model;

class PermissionRepository extends CoreRepository
{
    protected function getModelClass()
    {
        return Model::class;
    }

    // public function getItems($perPage = null)
    // {
    //     return $this->get('*', null, $perPage);
    // }
}
?>