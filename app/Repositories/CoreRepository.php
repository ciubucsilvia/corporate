<?php

namespace App\Repositories;

use Image;
use Illuminate\Support\Facades\File;
use stdClass;

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

    // V1
    // protected function get($select = '*', $take = null, $perPage = null)
    // {
    //     $result = $this->startConditions()
    //         ->select($select)
    //         ->orderBy('created_at', 'DESC');
    //     if($take) {
    //         $result->take($take);
    //     }

    //     if($perPage) {
    //         return $result->simplePaginate($perPage);
    //     } else {
    //         return $result->get();
    //     }
    // }
    
    // V2
    // public function getItems($take = null, $select = '*', $perPage = null, $where = null)
    // {
    //     $result = $this->startConditions()
    //         ->select($select)
    //         ->orderBy('created_at', 'DESC');
        
    //     if($where) {
    //         $result->where($where[0], $where[1]);
    //     }
        
    //     if($take) {
    //         $result->take($take);
    //     }

    //     if($perPage) {
    //         return $result->paginate(config('settings.paginate'));
    //     } 
            
    //     return $result->get();
    // }

    // V3
    public function getItems($attributes)
    {
        // Set default parameter
        if(!isset($attributes->columns)) {
            $attributes->columns = '*';
        }

        $result = $this
            ->startConditions()
            ->orderBy('id', 'DESC')
            ->select($attributes->columns);
        
        if(isset($attributes->where)) {
            $result->where($attributes->where[0], $attributes->where[1]);
        }

        if(isset($attributes->take)) {
            $result->take($attributes->take);
        }

        if(isset($attributes->with)){
            $result->with($attributes->with);
        }
        if(isset($attributes->perPage)) {
            return $result->paginate($attributes->perPage);
        } else {
            return $result->get();
        }     
    }

    public function getBySlug($slug)
    {
        $result = $this->startConditions()
            ->where('slug', $slug)
            ->first();
        
        return $result;
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

    public function getForCheckbox()
    {
        $columns = ['name', 'id'];
        $attributes = new \stdClass;
        $attributes->collumns = $columns;
        $result = $this->getItems($attributes);
        
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