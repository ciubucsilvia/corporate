<?php

namespace App\Repositories;

use Image;
use Illuminate\Support\Facades\File;

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
            ->orderBy('created_at', 'DESC');
        
        if($perPage) {
            return $result->simplePaginate($perPage);
        } else {
            return $result->get();
        }
    }

    public function getById($id)
    {
        return $this->startConditions()->find($id);
    }

    public function getForComboBox($column = 'title') 
    {
        $result = $this
            ->startConditions()
            ->pluck($column, 'id');
        
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

    public function removeImage($model, $folder)
    {
        $path = $this->getPublicPath($folder);
        $images = json_decode($model->image);
        
        foreach($images as $image){
            $file = $path . '/' . $image;
             
            if(File::exists($file)) {
                File::delete($file);
            }
        }
    }

    public function setIsPublished($model, $data)
    {
        $model->is_published = isset($data['is_published']) ? true : false;
        $model->published_at = now();
        $model->save();
    }

    public function setUser($model)
    {
        $model->user_id = auth()->user()->id;
        $model->save();
    }
}
?>