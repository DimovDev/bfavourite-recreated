<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{

   /**
     * Create a new controller instance.
     *
     * @return void
    */
    
    public function __construct()
    {
    }
   
   public function test() {

      return view('admin/home/test');

   }
   
   public function index() {
       
       return view('admin/home/index');


    }
}
