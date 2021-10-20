<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Http\Request;

class CostController extends Controller
{
    public function index() {
        $cities = City::all();

        return view('admin.manager.cost.index',compact('cities'));
    }

    public function edit(Request $request) {
        if($request){
//            $city = City::find($request->id);
//            dd($city);
            City::find($request->id)->update([
                'phivanchuyen' => (int)$request->cost,
            ]);

            return response()->json([
                'code' => 200,
            ],200);
        }
    }
}
