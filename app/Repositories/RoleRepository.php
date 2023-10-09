<?php

namespace App\Repositories;

use Spatie\Permission\Models\Role as Model;

class RoleRepository extends CoreRepository
{
    protected function getModelClass()
    {
        return Model::class;
    }

    // public function getItems($perPage = null)
    // {
    //     return $this->get('*', $perPage);
    // }
}
?>