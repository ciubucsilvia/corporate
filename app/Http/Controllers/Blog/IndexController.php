<?php

namespace App\Http\Controllers\Blog;

class IndexController extends BaseController
{
    public function __construct()
    {
        $this->template = env('THEME') . '.index';
        $this->title = 'Pink Rio | A strong, powerful and multiporpose Theme';
    }
    public function index()
    {
        return $this->renderOutput();
    }
}
