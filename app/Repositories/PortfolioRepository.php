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

    // public function getItems($perPage = null)
    // {
    //     return $this->get($select, null, $perPage);
    // }

    public function getPortfolio($take = null)
    {
       $select = ['id', 'title', 'slug', 'image', 'category_id', 'content'];
        
       $result = $this->getItems($take, $select);
       
       return $result;
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