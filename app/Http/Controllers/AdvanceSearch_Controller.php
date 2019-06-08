<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdvanceSearch_Controller extends Controller
{
    public function  category_define()
    {
        $data=request()->validate([
            'category'=>'required'
        ]);
        $x=request('category');
        if($x==1){
            return View('Add.add_movie');
        }else if($x==2){
            return view('Add.add_actor');
        }else{
            return view('Add.add_director');
        }
    }
}
