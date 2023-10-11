<?php

namespace App\Repositories;

use App\Models\Slider as Model;
use Illuminate\Support\Str;
use Spatie\Image\Image;

class SliderRepository extends CoreRepository
{
    protected function getModelClass()
    {
        return Model::class;
    }

    public function getSliders($take = null, $where = null)
    {
        $attributes = new \stdClass;
        $attributes->columns = [
            'id', 
            'title', 
            'image', 
            'active'
        ];
        if(isset($take)) {
            $attributes->take = $take;
        } else {
            $attributes->perPage = config('settings.paginate');
        }

        if(isset($where)) {
            $attributes->where = $where;
        }
        
       return $this->getItems($attributes);
    }

    public function saveImage($slider, $file)
    {
        $path = $this->getPublicPath('sliders');

        if($file->isValid()){
            $name = Str::random(8);

            $object = new \stdClass;
            $object->mini = $name . '_mini.jpg';
            $object->max = $name . '_max.jpg';
            $slider->image = json_encode($object);
            
            $miniWidth = config('settings.sliders.image.mini.width');
            $miniHeight = config('settings.sliders.image.mini.height');
            $this->resizeImage($file, $path, $miniWidth, $miniHeight, $object->mini);

            $maxWidth = config('settings.sliders.image.max.width');
            $maxHeight = config('settings.sliders.image.max.height');
            $this->resizeImage($file, $path, $maxWidth, $maxHeight, $object->max);
            
            return $slider;
        }
    }
}
?>