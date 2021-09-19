<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function connect(Request $request){
        if($request->username=='Fadel' AND $request->password='Fadel'){
            $request->session()->put('connect', true);
            return redirect('/admin/addPost');
        }
        else{
            $request->session()->flash('error', 'Unauthorized!');
            return back();
        }
    }
}
