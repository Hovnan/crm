<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Sentinel;

class DirectionController extends Controller
{
    public function store (Request $request, $branch_id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:directions'
        ]);
        if ($validator->fails()) {

            return response()->json(['errors' => $validator->errors()], 500 );

        }else{
            
        $user = Sentinel::getUser();
        $record = $user->records()->where('branch_id', $branch_id)->first();
        $branch = $record->branch;

        if ($request->name) {
            $direction = $branch->directions()->create([
                'name' => $request->name
            ]);
            return response()->json($direction);
            //return response()->json('good');
            //return response()->json(['redirect' => '/customers/'.$branch_id.'/'.$id]);
        }

    }
        //return response()->json(['error' => 'Wrong data'], 500);
        //return response()->json('error');

    }
}
