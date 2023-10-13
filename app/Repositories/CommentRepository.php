<?php

namespace App\Repositories;

use App\Models\Comment as Model;

class CommentRepository extends CoreRepository
{
    protected function getModelClass()
    {
        return Model::class;
    }

    public function getComments($take = null)
    {
        $attributes = new \stdClass;
        $attributes->columns = [
            'id', 
            'text', 
            'author',
            'email',
            'website',
            'image',
            'parent_id',
            'article_id'
        ];

        if($take) {
            $attributes->take = $take;
        } else {
            $attributes->perPage = config('settings.paginate');
        }

        return $this->getItems($attributes);
    }
}
?>