<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Mail;

class ContactController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if($request->isMethod('post')){
        	
        	$this->validate($request, [
        		'name' => 'required|max:255',
        		'email' => 'required|email',
        		'message' => 'required',
        	]);

        	$data = $request->all();

        	$result = Mail::send(env('THEME') . '.email', ['data' => $data], function($message) use ($data) {

        		$mail_admin = env('MAIL_ADMIN');
                $message->from($data['email'], $data['name']);
                $message->to($mail_admin)->subject('Question');
        	});

        	if($result){
                return redirect()->route('contact')
                                ->with('status', 'Email is send');
            }
        }

        $this->title = 'Contact';

        $this->content = view(env('THEME') . '.contact_content')
                        ->render();

        // SIDEBAR        
        $this->sidebar = view(env('THEME') . '.contactBar')
                                    ->render();

        return $this->renderOutput();
    }
}
