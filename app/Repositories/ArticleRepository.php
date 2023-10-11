<?php

namespace App\Repositories;

use App\Models\Article as Model;
use Illuminate\Support\Str;
use stdClass;

class ArticleRepository extends CoreRepository
{
    protected function getModelclass()
    {
        return Model::class;
    }

    public function getArticles($take = null, $where = null)
    {
        $attributes = new stdClass;
        $attributes->with = [
            'category:id,title', 
            'user:id,name'
        ];
        $attributes->columns = [
            'id', 
            'title', 
            'slug', 
            'image', 
            'category_id', 
            'user_id',
            'text',
            'published_at'
        ];

        if($take) {
            $attributes->take = $take;
        } else {
            $attributes->perPage = config('settings.paginate');
        }

        if($where) {
            $attributes->where = $where;
        }
        
       return $this->getItems($attributes);
    }

    public function saveImage($article, $file, $folder)
    {
        $path = $this->getPublicPath($folder);

        if($file->isValid()){
            $name = Str::random(8);

            $object = new \stdClass;
            $object->mini = $name . '_mini.jpg';
            $object->max = $name . '_max.jpg';

            $article->image = json_encode($object);
            
            $miniWidth = config('settings.articles.image.mini.width');
            $miniHeight = config('settings.articles.image.mini.height');
            $this->resizeImage($file, $path, $miniWidth, $miniHeight, $object->mini);

            $maxWidth = config('settings.articles.image.max.width');
            $maxHeight = config('settings.articles.image.max.height');
            $this->resizeImage($file, $path, $maxWidth, $maxHeight, $object->max);
            
            return $article;
        }
        return false;
    }
}
?>