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
        $select = '*';

       return $this->get($select, $perPage);
    }

    public function saveImage($slider, $file)
    {
        $path = $this->getPublicPath('sliders');

        if($file->isValid()){
            $name = Str::random(8);

            $object = new \stdClass;
            $object->mini = $name . '_mini.jpg';
            $object->max = $name . '_max.jpg';
            
            $miniWidth = config('settings.slider.mini.width');
            $miniHeight = config('settings.slider.mini.height');
            $maxWidth = config('settings.slider.max.width');
            $maxHeight = config('settings.slider.max.height');

            $image_mini = $this->resizeImage($file, $path, $miniWidth, $miniHeight, $object->mini);
            $image_max = $this->resizeImage($file, $path, $maxWidth, $maxHeight, $object->max);
            
            $slider->image = json_encode($object);

            return $slider;
        }
    }
}
?>