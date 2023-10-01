<?php

namespace App\Repositories;

use Image;

abstract class CoreRepository
{
    protected $model;

    public function __construct()
    {
        $this->model = app($this->getModelClass());
    }

    abstract protected function getModelClass();

    protected function startConditions()
    {
        return clone $this->model;
    }

    protected function get($select = '*', $perPage = null)
    {
        $result = $this->startConditions()
            ->select($select)
            ->simplePaginate($perPage);
        
        return $result;
    }

    protected function getPublicPath($folder)
    {
        return public_path() . '/' . env('THEME') . '/images/' . $folder;
    }

    protected function resizeImage($file, $path, $width, $height, $name)
    {
        if(!file_exists($path)) {
            mkdir($path, 666, true);
        }

        $image = Image::make($file->path());
        $image->resize($width, $height)
            ->save($path . '/' . $name);
    
        return $image;
    }

    public function setActive($model, $data)
    {
        if(isset($data['active'])) {
            $model->active = true;
        } else {
            $model->active = false;
        }
        return $model->save();
    }
}
?>