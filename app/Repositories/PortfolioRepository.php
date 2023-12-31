<?php

namespace App\Repositories;

use App\Models\Portfolio as Model;
use Illuminate\Support\Str;

class PortfolioRepository extends CoreRepository
{
    protected function getModelclass()
    {
        return Model::class;
    }

    
    public function getPortfolios($take = null)
    {
        $attributes = new \stdClass;

        $attributes->with = ['category:id,title'];
        $attributes->columns = [
            'id', 
            'title', 
            'slug', 
            'image', 
            'category_id'
        ];

        if($take) {
            $attributes->take = $take;
        } else {
            $attributes->perPage = config('settings.paginate');
        }
        
       return $this->getItems($attributes);
    }

    public function saveImage($portfolio, $file)
    {
        $path = $this->getPublicPath('portfolios');

        if($file->isValid()){
            $name = Str::random(8);

            $object = new \stdClass;
            $object->mini = $name . '_mini.jpg';
            $object->max = $name . '_max.jpg';

            $portfolio->image = json_encode($object);
            
            $miniWidth = config('settings.portfolio.image.mini.width');
            $miniHeight = config('settings.portfolio.image.mini.height');
            $this->resizeImage($file, $path, $miniWidth, $miniHeight, $object->mini);

            $maxWidth = config('settings.portfolio.image.max.width');
            $maxHeight = config('settings.portfolio.image.max.height');
            $this->resizeImage($file, $path, $maxWidth, $maxHeight, $object->max);
            
            return $portfolio;
        }
        return false;
    }
}
?>