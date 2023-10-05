<?php

namespace App\Http\Controllers\Blog\Admin;

use App\Models\Slider;
use App\Http\Requests\StoreSliderRequest;
use App\Http\Requests\UpdateSliderRequest;
use App\Repositories\SliderRepository;

class SliderController extends AdminController
{
    private $slider_repository;

    public function __construct()
    {
        parent::__construct();

        $this->slider_repository = app(SliderRepository::class);

        $this->title = 'Slider';
        $this->folder = 'sliders';
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(!$this->user->hasPermissionTo('View Sliders')){
            abort(403);
        }

        $this->title .= 's';
        
        $paginator = $this->slider_repository->getItems(10);
        
        $this->content = view(env('THEME') . '.admin.sliders.index', 
            compact('paginator'));
        
            return $this->renderOutput();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if(!$this->user->hasPermissionTo('Create Slider')) {
            abort(403);
        }

        $this->title .= '::create';
        $this->content = view(env('THEME') . '.admin.sliders.create');
        return $this->renderOutput();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSliderRequest $request)
    {
        $data = $request->all();
        $slider = Slider::create($data);
        
        // Save image in folder 'public' and in DB
        if($request->hasFile('image')) {
            $file = $request->file('image');
            $slider = $this->slider_repository->saveImage($slider, $file);
        }
        
        // set property 'active' 
        $this->slider_repository->setActive($slider, $data);
        
        return redirect()
            ->route('admin.sliders.index')
            ->with(['success' => 'Successfully saved!']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Slider $slider)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Slider $slider)
    {
        if(!$this->user->hasPermissionTo('Update Slider')) {
            abort(403);
        }

        $this->title .= '::update';

        $this->content = view(env('THEME') . '.admin.sliders.edit', 
            compact('slider'));
        return $this->renderOutput();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSliderRequest $request, Slider $slider)
    {
        $data = $request->all();
        $slider->update($data);
         
        if($request->hasFile('image')){
            $file = $request->file('image');
            $this->slider_repository->removeImage($slider, $this->folder);
            $slider = $this->slider_repository->saveImage($slider, $file);
        }
        
        // set property 'active' 
        $this->slider_repository->setActive($slider, $data);

        return redirect()
            ->route('admin.sliders.index')
            ->with(['success' => 'Successfully updated!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Slider $slider)
    {
        if(!$this->user->hasPermissionTo('Delete Slider')) {
            abort('403');
        }

        $slider->delete();
        $this->slider_repository->removeImage($slider, $this->folder);

        return redirect()
            ->route('admin.sliders.index')
            ->with(['success' => 'Successfully deleted!']);
    }
}
