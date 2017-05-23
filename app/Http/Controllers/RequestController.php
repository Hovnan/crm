<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Validator;
use Sentinel;

class RequestController extends Controller
{
    protected $active = 'requests';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($branch_id)
    {
        $user = Sentinel::getUser();
        $record = $user->records()->where('branch_id', $branch_id)->first();
        $branch = $record->branch;
        $requests = $branch->requests;
        $company = $branch->company;
        return view('requests.index', [
            'user' => $user,
            'record' => $record,
            'branch' => $branch,
            'requests' => $requests,
            'active' => $this->active,
            'company' => $company
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $branch_id)
    {
       /* $validator = Validator::make($request->all(), [
            'name' => 'required',
            'post' => 'required|email',
            'phone' => 'required',
        ]);
        if ($validator->fails()) {

            return response()->json(['errors' => $validator->errors()], 500 );

        }else{*/
            $user = Sentinel::getUser();
            $record = $user->records()->where('branch_id', $branch_id)->first();
            $branch = $record->branch;
            $req = $branch->requests()->create([
                'name' => $request->name,
                'post' => $request->post,
                'phone' => $request->phone,
                'comment' => $request->comment
            ]);
            //session answer with success

            return response()->json(['redirect' => '/requests/'.$branch_id]);
        //}
    }

    public function search(Request $request, $branch_id)
    {
        //$branch_id;
        $user = Sentinel::getUser();
        //dd($user);
        $record = $user->records()->where('branch_id', $branch_id)->first();
        $branch = $record->branch;
        $req = $branch->requests();

        //dd($req->get());
        $company = $branch->company;
        
        if($request->search){
            $req = $req->where('name', 'LIKE', "%$request->search%");
        }
        $req = $req->get();
        $request->flash();

        return view('requests.index', [
            'user' => $user,
            'record' => $record,
            'branch' => $branch,
            'requests' => $req,
            'active' => $this->active,
            'company' => $company
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /*public function show($id)
    {
        dd($id);
    }*/

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($branch_id, $id)
    {
        $user = Sentinel::getUser();
        $record = $user->records()->where('branch_id', $branch_id)->first();
        $branch = $record->branch;
        $company = $branch->company;
        $request = $branch->requests()->where('id', $id)->first();

        /*if ($subscriber->childs->first()){
            return redirect()->back();
        }*/

        return view('requests.edit', [
            'now' => Carbon::now(),
            'record' => $record,
            'user' => $user,
            'branch' => $branch,
            'company' => $company,
            'active' => $this->active,
            'request' => $request
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $branch_id, $id)
    {
       /* $validator = Validator::make($request->all(), [
            'name' => 'required',
            'post' => 'required|email',
            'phone' => 'required'
        ]);
        if ($validator->fails()) {

            return response()->json(['errors' => $validator->errors()], 500 );

        }else{*/
            $user = Sentinel::getUser();
            $record = $user->records()->where('branch_id', $branch_id)->first();
            $branch = $record->branch;
            $req = $branch->requests()->where('id', $id)->update([
                'name' => $request->name,
                'post' => $request->post,
                'phone' => $request->phone,
                'comment' => $request->comment
            ]);
            //session answer with success

            return response()->json(['redirect' => '/requests/'.$branch_id]);
        //}
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
