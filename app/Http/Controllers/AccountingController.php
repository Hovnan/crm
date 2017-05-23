<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Sentinel;

class AccountingController extends Controller
{
    protected $active = 'accountings';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($branch_id)
    {
        //$branch_id;
        $user = Sentinel::getUser();
        //dd($user);
        $record = $user->records()->where('branch_id', $branch_id)->first();
        $branch = $record->branch;
        $accountings  = $branch->accountings;
        $company = $branch->company;
        return view('accountings.index', [
            'user' => $user,
            'record' => $record,
            'branch' => $branch,
            'company' => $company,
            'active' => $this->active,
            'accountings'  => $accountings
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
        $user = Sentinel::getUser();
        $record = $user->records()->where('branch_id', $branch_id)->first();
        $branch = $record->branch;
        $accounting = $branch->accountings()->create([
            'name' => $request->name,
            'amount' => $request->amount,
            'when' => $request->when,
            'coment' => $request->coment
        ]);
        return redirect()->back();
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
    public function edit($id)
    {
        //
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
        //
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
