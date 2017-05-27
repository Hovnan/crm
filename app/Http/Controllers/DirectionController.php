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

    public function show (Request $request, $branch_id)
    {
        $user = Sentinel::getUser();
        $record = $user->records()->where('branch_id', $branch_id)->first();
        $branch = $record->branch;
        $direction = $branch->directions()->where('id', $request->id)->first();
        $data = '';

        $data .= '<div class="col-md-8">'.
                                    '<div class="form-group" id="training_id">'.
                                        '<label for="tr">Название занятия *</label>'.
                                        '<select class="form-control1" name="training_id" id="tr" onchange="showEmployees()">'.
                                            '<option value="">Select Training</option>';
                                            foreach($direction->trainings as $training){
                                                $data .= '<option value="'. $training->id .'">'. $training->name .'</option>';
                                            }
                                        '</select>'.
                                        '<span class="help-block"></span>'.
                                    '</div>'.
                                '</div>'.
                                '<div class="clearfix"> </div>';
/*
        if ($request->name) {
            $direction = $branch->directions()->create([
                'name' => $request->name
            ]);*/
            return response()->json($data);
            //return response()->json('good');
            //return response()->json(['redirect' => '/customers/'.$branch_id.'/'.$id]);
       // }
        
        //return response()->json(['error' => 'Wrong data'], 500);
        //return response()->json('error');

    }
}
