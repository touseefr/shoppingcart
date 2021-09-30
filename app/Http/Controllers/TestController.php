<?php

namespace App\Http\Controllers;

use App\Models\Test;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function dyna()
    {
        return view('dyna');
    }

    public function submit(Request $request)
    {
        $tests=[];
      //  dd($request->all());
      $t=New Test;
      $tests[]=$request->name;
     // dd($tests);
     $t->name=$tests;
      $t->save();
      return back();
    }
}
