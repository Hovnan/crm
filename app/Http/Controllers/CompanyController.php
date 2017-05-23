<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Company;
use Sentinel;

class CompanyController extends Controller
{

    public function __construct()
    {
        $this->middleware('owners');
    }

    public function index()
    {
        $user = Sentinel::getUser();
        $companies = $user->companies;
        
        return view('companies.index')->withUser($user)->withCompanies($companies);

    }

    public function create()
    {

    }
    public function store (Request $request)
    {
        $user = Sentinel::getUser();
        /*
         * if($user->hasAccess(['companies.create', 'companies.update'])){}
         * if($user->hasAnyAccess(['companies.create', 'companies.update'])){}
         * if($user->hasAccess('companies.*')){}
         * */
        // if($user->hasAccess('companies.create')){
        //return $request->all();
        //$company = $user->companies()->create([
        $user->companies()->create([
            'name' => $request->name,
            'domain' => 'sub'.$request->name,
        ]);

        /* $user->companies()
             $company = new Company();
             $company->name = $request->name;
             $company->domain = 'sub'.$request->name;
             $company->user_id = $user->id;
             $company->save();*/
        return redirect()->back();
        //  }
        // abort(403, 'Unauthorith action');
    }
    public function show($id)
    {
        $user = Sentinel::getUser();
        $company = Company::find($id);

        //$role = Sentinel::findRoleById(3);

        /*$role->permissions = [
            "customer" => true,
            "employee" => true,
        ];

        $role->save();*/

        /*if($user->id == $company->user->id)
        {
            return view('companies.show')->withCompany($company);
        }
        return redirect()->back();*/
        $role = 'owner';
        return view('companies.show')->withUser($user)->withCompany($company)->withRole($role);
    }
    public function edit ($id)
    {
        $user = Sentinel::getUser();
        //$user->companies()->where('user_id', $user->);
        $company = Company::find($id);
        //$company = Company::where('user_id', $user->id);
        if($company->user_id == $user->id){
            return view('companies.edit')->withCompany($company);
        }else{
            die('error');
        }
        
    }
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'domain' => 'required',
        ]);
        $user = Sentinel::getUser();
        $company = Company::find($id);
        if($company->user_id == $user->id){
            
            $company->name = $request->name;
            $company->domain = $request->domain;

            $company->save();

            return redirect()->route('companies.show', ['company' => $id]);
        }else{
            die('error');
        }

        
    }
    public function destroy($id)
    {
        
    }
}
