<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
        $data['categories']  = Category::orderBy('id','asc')->get(); 
        return view('welcome',$data);
    }
}
