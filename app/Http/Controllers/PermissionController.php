<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Sentinel;
use App\User;

class PermissionController extends Controller
{
        
    public function store (Request $request){

        $user = User::find($request->id);
        $record = $user->records()->where('branch_id', $request->branch_id)->first();

        if(array_key_exists($request->permission, $record->permissions)){

            $permiss = $record->permissions;
            unset($permiss[$request->permission]);
            $record->permissions = $permiss;
        }
        $record->save();

        return response()->json('add');
    }
    
    public function remove (Request $request)
    {
        $user = User::find($request->id);
        $record = $user->records()->where('branch_id', $request->branch_id)->first();

        $permiss = $record->permissions;
        $permiss[$request->permission] = '0';

        $record->permissions = $permiss;
        $record->save();

        return response()->json('removed');
    }
}
