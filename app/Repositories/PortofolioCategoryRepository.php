<?php

namespace App\Repositories;

use App\Models\PortfolioCategory as Model;

class PortofolioCategoryRepository extends CoreRepository
{
    protected function getModelClass()
    {
        return Model::class;
    }

    public function getCategories()
    {
        $attributes = new \stdClass;
        $attributes->perPage = config('settings.paginate');
        $attributes->columns = [
            'id', 
            'title', 
            'slug',
        ];

        return $this->getItems($attributes);
    }
}
?>