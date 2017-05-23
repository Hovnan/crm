<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Validator;
use Sentinel;

class SubscriberController extends Controller
{
    protected $active = 'subscribers';
    /*
    protected $months = [
        '1' => 'Один месяц',
        '2' => 'Два месяца',
        '3' => 'Три месяца',
        '4' => 'Четыре месяца',
        '5' => 'Пять месяца',
        '6' => 'Пол года',
        '7' => 'Сэм месяца',
        '8' => 'Восемь месяца',
        '9' => 'Девять месяца',
        '10' => 'Десять месяца',
        '11' => 'Одиннадцать месяца',
        '12' => 'На год',
    ];*/

    public function __construct()
    {
         //
    }

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
        $subscribers = $branch->subscribers;
        $company = $branch->company;
        return view('subscribers.index', [
            'user' => $user,
            'record' => $record,
            'branch' => $branch,
            'company' => $company,
            'active' => $this->active,
            'subscribers' => $subscribers
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
        //return response()->json(['errors' => $request->type], 500 );
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:subscribers',
            'type' => 'required|numeric',
            'validity' => 'required',
            'visits' => 'required',
            'price' => 'required|numeric',
            'freeze' => 'numeric',
        ]);
        if ($validator->fails()) {

            return response()->json(['errors' => $validator->errors()], 500 );

        }else{
            $user = Sentinel::getUser();
            $record = $user->records()->where('branch_id', $branch_id)->first();
            $branch = $record->branch;
            $subscriber = $branch->subscribers()->create([
                'name' => $request->name,
                'type' => $request->type,
                'price' => $request->price,
                'visits' => $request->visits ? $request->visits : null,
                'validity' => $request->validity ? $request->validity : null,
                'freeze' => $request->freeze ? $request->freeze : null
            ]);
            //session answer with success
            return response()->json(['redirect' => '/subscribers/'.$branch_id]);
        }
    }

    public function search(Request $request, $branch_id)
    {
        
        $user = Sentinel::getUser();
        $record = $user->records()->where('branch_id', $branch_id)->first();
        $branch = $record->branch;
        $company = $branch->company;
        $subscribers = $branch->subscribers();
        /*$subscriber = $branch->subscribers()->create([
            'name' => $request->name,
            'price' => $request->price,
            'visits' => $request->visits,
            'validity' => $request->validity
        ]);*/

        if($request->search){
            $subscribers = $subscribers->where('name', 'LIKE', "%$request->search%")
                ->orWhere('price', 'LIKE', "%$request->search%");
        }
        $subscribers = $subscribers->get();
        $request->flash();

        //session answer with success

        return view('subscribers.index', [
            'user' => $user,
            'record' => $record,
            'branch' => $branch,
            'company' => $company,
            'active' => $this->active,
            'subscribers' => $subscribers
        ]);    


    }

    public function unFixed(Request $request)
    {
        $user = Sentinel::getUser();
        $record = $user->records()->where('branch_id', $request->branch_id)->first();
        $branch = $record->branch;
        //$company = $branch->company;
        $subscribers = $branch->subscribers();

        if($request->visit){
            $subscribers = $subscribers->where('type', '1');
                //->orWhere('price', 'LIKE', "%$request->search%");
        }
        $subscribers = $subscribers->get();
        foreach ($subscribers as $sub){
            $v = explode('-', $sub->visits);
            if($v[0] <= $request->visit && $v[1] >= $request->visit){
                return response()->json($request->visit * $sub->price);
                break;
            }
        }
        //return response()->json(['error' => 'Wrong data'], 500);
        return response()->json('error');
    }

    public function selectPrice(Request $request)
    {
        $user = Sentinel::getUser();
        $record = $user->records()->where('branch_id', $request->branch_id)->first();
        $branch = $record->branch;
        //$company = $branch->company;
        $subscribers = $branch->subscribers();

        if($request->id){
            $subscriber = $subscribers->find($request->id);

            return response()->json($subscriber->price);
        }
        /*$subscribers = $subscribers->get();
        foreach ($subscribers as $sub){
            $v = explode('-', $sub->visits);
            if($v[0] <= $request->visit && $v[1] >= $request->visit){
                return response()->json($request->visit * $sub->price);
                break;
            }
        }*/
        //return response()->json(['error' => 'Wrong data'], 500);
        return response()->json('error');
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
        //$customers = $branch->customers;
        //$subscribers = $branch->subscribers; //()->where('childs.id', $id)->first();
        //$child->subscribers()->where('childs.id', $id)->first();
        // dd($record);
        $company = $branch->company;
        $subscriber = $branch->subscribers->where('id', $id)->first();
        
        /*if ($subscriber->childs->first()){
            return redirect()->back();
        }*/

        return view('subscribers.edit', [
            'now' => Carbon::now(),
            'record' => $record,
            'user' => $user,
            'branch' => $branch,
            'company' => $company,
            'active' => $this->active,
            'subscriber' => $subscriber
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
        $validator = Validator::make($request->all(), [
            'type' => 'required|numeric',
            'validity' => 'required',
            'visits' => 'required',
            'price' => 'required|numeric',
            'freeze' => 'numeric',
        ]);
        if($request->old_name != $request->name){
            $validator = Validator::make($request->all(), [
                'name' => 'required|unique:subscribers'
            ]);
        }
        if ($validator->fails()) {

            return response()->json(['errors' => $validator->errors()], 500 );

        }else{
            $user = Sentinel::getUser();
            $record = $user->records()->where('branch_id', $branch_id)->first();
            $branch = $record->branch;
            $subscriber = $branch->subscribers()->where('id', $id)->update([
                'name' => $request->name,
                'type' => $request->type,
                'price' => $request->price,
                'visits' => $request->visits ? $request->visits : null,
                'validity' => $request->validity ? $request->validity : null,
                'freeze' => $request->freeze ? $request->validity : null
            ]);
            //session answer with success
            return response()->json(['redirect' => '/subscribers/'.$branch_id]);
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
