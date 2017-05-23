<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Company;
use App\Branch;
use Sentinel;

class BranchController extends Controller
{
    public function __construct()
    {
        return $this->middleware('owners');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //dont need
        
        
        //$user = Sentinel::getUser();
        
        //$branch = Branch::all();

       // return view('branches.index')->withUser($user);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    /*public function create()
    {
        $user = Sentinel::getUser();

        return view('branches.create')->withUser($user);
    }*/

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request$branch = $company->branches()->create([
    'name' => $request->name,
    'address' => $request->address,
    ]);
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Sentinel::getUser();

        //validation importatnt
        $company = Company::find($request->company_id);
        if ($company->user_id == $user->id) {
            $branch = $company->branches()->create([
                'name' => $request->name,
                'address' => $request->address
            ]);
        }
        $record = $user->records()->create([
            'branch_id' => $branch->id,
            'role' => 'owner'
        ]);
        return redirect()->route('dashboard.show', ['branch' => $branch->id]);
        //return redirect()->route('users.show', ['user' => $user->id]);
        //return response()->json($branch->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)//????????
    {
        $user = Sentinel::getUser();//???
//dd($user->companies);
        $parent = $user->parent == 0 ? $user->id : $user->parent;//????

        $branch = Branch::find($id);//?????
       // $branch = Branch::all();
       // $companies =Company::find($branch->company_id);
        //if($companies->user_id == $parent)
        //{
            return view('branches.show')->withBranch($branch);
       // }
        //return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = Sentinel::getUser();

        $branch = Branch::find($id);

        $chack = $user->branches()->where('id', $branch->id)->first();
        if($chack){
            return view('branches.edit')->withBranch($branch);
        }else{
            die('no Access');
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = Sentinel::getUser();

        $this->validate($request, [
            'name' => 'required|max:255',
            'address' => 'required',
        ]);

        $branch = Branch::find($id);

        if($user->branches()->where('id', $branch->id)->first())
        {
            $branch->name= $request->name;
            $branch->address= $request->address;

            $branch->save();

            //return redirect()->route('branches.show', ['branch' => $id]);
            return redirect()->route('users.show', ['user' => $user->id]);
        }else{
            die('no Access');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
