<?php

namespace App\Repositories;

use App\Models\ArticleCategory as Model;
use stdClass;

class ArticleCategoryRepository extends CoreRepository
{
    protected function getModelClass()
    {
        return Model::class;
    }

    public function getCategories()
    {
        $attributes = new stdClass;
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