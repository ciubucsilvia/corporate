<?php

namespace App\Repositories;

use App\Models\PortfolioCategory as Model;

class PortofolioCategoryRepository extends CoreRepository
{
    protected function getModelClass()
    {
        return Model::class;
    }

    // public function getItems($perPage = null)
    // {
    //     $select = ['id', 'title', 'slug', 'description'];
    //     $result = $this->get($select, $perPage);
    //     return $result;
    // }
}
?>