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

    public function getItems($perPage = null)
    {
        $select = ['id', 'title', 'active', 'image'];

       $result = $this->get($select, $perPage);
       
       return $result;
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