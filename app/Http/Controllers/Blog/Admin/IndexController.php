<?php

namespace App\Http\Controllers\Blog\Admin;

class IndexController extends AdminController
{
    public function __construct()
    {
        parent::__construct();
        
        $this->title = 'Admin'; 
    }
    
    public function index()
    {
        return $this->renderOutput();
    }
}
