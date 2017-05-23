<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Sentinel;

class DashboardController extends Controller
{
    protected $active = 'dashboard';

    public function show($branch_id = null)
    {
        $user = Sentinel::getUser();


        $rec = $branch_id ? $user->records()->where('branch_id', $branch_id)->first() : false;

        $record = $rec ? $rec : $user->records()->first();

        $branch = $record? $record->branch : false;
        //dd($branch);

        $company = $branch ? $branch->company : $user->companies()->first();
        

        //$role = $branch ? $user->records()->role()->where('branch_id', $branch->id)->first() : 'Set the role';
        //$role = $user->records()->where('branch_id', $branch->id)->first()->role;
        //$record = $user->records()->where('branch_id', $branch->id)->first();
        return view('dashboard.show', [
            'user'    => $user, 
            'record'    => $record, 
            'company' => $company,
            'active' => $this->active,
            'branch'  => $branch
        ]);
    }

    public function profile ($branch_id)
    {
        
        if(!$branch_id) 
        {
            return redirect()->back();
        }

        $user = Sentinel::getUser();
        //$company = Company::find($company_id);

        //$record = $branch_id ? $user->records()->where('branch_id', $branch_id)->first() : false;

        //$branch = $record ? $record->branch : $user->records()->first()->branch;
        $rec = $branch_id ? $user->records()->where('branch_id', $branch_id)->first() : false;


        $record = $rec ? $rec : $user->records()->first();
        $branch = $record? $record->branch : false;

        $company = $branch ? $branch->company : $user->companies()->first();
        
        if(!$branch) //i must make middleware for branches
        {
            return redirect()->back();
        }

        //$company = $branch ? $branch->company : $user->companies()->first();
        //$company = $branch->company;
        //$role = 'admin';//$user->role[$branch->id];
        $access = [
            'abonements'  => '<img src="/imgs/abonements_icon.png" width="13px">',
            'bookkeeping'  => '<img src="/imgs/bookkeeping_icon.png" width="13px">',
            'employees'  => '<img src="/imgs/employees_icon.png" width="13px">',
            'lessons'  => '<img src="/imgs/lessons_icon.png" width="13px">',
            'request'  => '<img src="/imgs/request_icon.png" width="13px">',
            'schedule'  => '<img src="/imgs/schedule_icon.png" width="13px">',
            'visitors'  => '<img src="/imgs/visitors_icon.png" width="13px">'
        ];
        return view('dashboard.profile', [
            'user'    => $user,
            'record'    => $record,
            'company' => $company,
            'branch'  => $branch,
            'access'  => $access,
            'active' => $this->active
        ]);

    }

    /*public function postShow(Request $request, $id)
    {
        $user = Sentinel::findById($id);
    }*/
}
