<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Setting;
use DB;
use Validator;

class IPBlockController extends Controller
{
    public function view()
    {
    	$settings = Setting::first();
    	return view('admin.ipblock.edit', compact('settings'));
    }

    public function update(Request $request)
    {

    	// $request->validate([
     //      'ipblock' => 'required|ipv4'
     //    ]);


        $setting = Setting::first();

	    $setting->ipblock = $request->ipblock;

	    $setting->save();



    	
        // $test = DB::table('settings')->update(
        //     ['ipblock' => $request->ipblock]
        // );

    	return back();
    }
}
