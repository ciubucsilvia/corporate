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
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->title .= 's';
        
        $paginator = $this->slider_repository->getItems(10);
        
        $this->content = view($this->envNameAdmin . '.sliders.index', 
            compact('paginator'));
        
            return $this->renderOutput();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->title .= '::create';
        $this->content = view($this->envNameAdmin . '.sliders.create');
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSliderRequest $request, Slider $slider)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Slider $slider)
    {
        //
    }
}
