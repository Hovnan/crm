<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Validator;
use Sentinel;

class CustomerController extends Controller
{
    protected $active = 'customers';
    protected $social = [
        'i-1' => '<i class="fa fa-vk" aria-hidden="true"></i>',
        'i-2' => '<i class="fa fa-facebook" aria-hidden="true"></i>',
        'i-3' => '<i class="fa fa-instagram" aria-hidden="true"></i>',
        'i-4' => '<i class="fa fa-twitter" aria-hidden="true"></i>',
        'i-5' => '<i class="fa fa-odnoklassniki" aria-hidden="true"></i>'
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($branch_id)
    {
        //$k = Carbon::now()->addMonth(18);
        //$k = Carbon::now()->toDateString();
        //$k = Carbon::now()->todatestring();

        //$k = Carbon::now()->addMinutes(61)->toTimeString();

        //$k = Carbon::now()->format("d.m.Y");
        //$k = Carbon::now()->subYears(3)->format("Y-m-d");
        //Carbon::parse($child->valid)->format("d.m.Y")
        
        $user = Sentinel::getUser();
        $record = $user->records()->where('branch_id', $branch_id)->first();
        $branch = $record->branch;
        $childs = $branch->childs;


        //dd($childs->first()->age->diffInYears());
        $company = $branch->company;
        $subscribers = $branch->subscribers;

        return view('customers.index', [
            'now' => Carbon::now(),
            'user' => $user,
            'social' => $this->social,
            'record' => $record,
            'branch' => $branch,
            'childs' => $childs,
            'active' => $this->active,
            'subscribers' => $subscribers,
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
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'phone' => 'required',
            'post' => 'required|email',
            'child_name' => 'required',
            'age' => 'required|date',
            'gender' => 'required'
        ]);
        if ($validator->fails()) 
        {
            return response()->json(['errors' => $validator->errors()], 500 );

        }else{
            $user = Sentinel::getUser();
            $record = $user->records()->where('branch_id', $branch_id)->first();
            $branch = $record->branch;
            $subscriber = $branch->subscribers();
            if($request->visit){
                $subscriber = $subscriber->where('type', '1')->get();
                foreach ($subscriber as $sub){
                    $v = explode('-', $sub->visits);
                    if($v[0] <= $request->visit && $v[1] >= $request->visit){
                       $subscriber = $sub;
                        break;
                    }
                }
            }else{
                $subscriber = $subscriber->where('id', $request->subscriber_id)->first();
            }

            $customer = $branch->customers()->create([
                'name' => $request->name,
                'phone'=> $request->phone,
                'post'=> $request->post,
                'social' => $request->social ? $request->social : [],
                'branch_id'=> $request->branch_id
            ]);

            $child = $customer->childs()->create([
                'child_name' => $request->child_name,
                'age'=> $request->age,
                'gender'=> $request->gender,
            ]);
            $company = $branch->company;
            $customers = $company->customers;

//dd($customers);
            $ch = [];
            foreach($customers as $cust){
                foreach($cust->childs as $child)
                {
                    $vis = $child->visits;
                    foreach ($vis as $vk){
                        $ch[] = $vk->number;
                    }
                }
                //dd(max($ch));

            }
            $num = empty($ch)? 1 : max($ch) +1;
            $visit = $child->visits()->create([
                'number' => str_pad($num, 5, '0', STR_PAD_LEFT),
                'subscriber_id' => $subscriber->id,
                'remainder' => $request->visit ? $request->visit : $subscriber->visits,
                'paid' => $request->paid,
                'valid' => $k = $subscriber->validity ? Carbon::now()->addMonth($subscriber->validity) : null,
            ]);

            return response()->json(['redirect' => '/customers/'.$branch_id]);
        }

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
        $child = $branch->childs()->where('childs.id', $id)->first();

       // dd();
        $company = $branch->company;
        $subscribers = $branch->subscribers;

        $subIds = [];
        foreach ($child->subscribers as $s){
            $subIds[] = $s->id;
        }
        return view('customers.edit', [
            'now' => Carbon::now(),
            'user' => $user,
            'social' => $this->social,
            'record' => $record,
            'branch' => $branch,
            'child' => $child,
            'active' => $this->active,
            'subIds' => $subIds,
            'subscribers' => $subscribers,
            'company' => $company
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
            'name' => 'required',
            'phone' => 'required',
            'post' => 'required|email',
            'child_name' => 'required',
            'age' => 'required|date',
            'gender' => 'required'
        ]);
        
        if ($validator->fails())
        {
            return response()->json(['errors' => $validator->errors()], 500 );

        }else{
            $user = Sentinel::getUser();
            $record = $user->records()->where('branch_id', $branch_id)->first();
            $branch = $record->branch;

            $child = $branch->childs()->where('childs.id', $id)->first();

            $customer = $child->customer;

            $customer->name = $request->name;
            $customer->phone = $request->phone;
            $customer->post = $request->post;
            $customer->social = $request->social ? $request->social : [];

            $customer->save();

            $child->child_name = $request->child_name;
            $child->age = $request->age;
            $child->gender = $request->gender;
            $child->save();

            //$child->subscribers()->attach($subscriber->id);

            //if($request->old_subscriber != $request->subscriber_id){
                /*$subscriber = $branch->subscribers()->where('id', $request->subscriber_id)->first();
                $visit = $child->visits->first();
                //$visit->child_id = $child->id;
                $visit->subscriber_id = $subscriber->id;
                $visit->remainder = $subscriber->visits;
                $visit->paid = $request->paid;
                $visit->valid = $subscriber->validity;
                
                $visit->save();*/
            //}

            /*$visit = Visit::where('child_id', $child->id)->where('subscriber_id', $subscriber->id);
            if($visit){

                $visit->remainder += $subscriber->visits;
            }*/
            //dd($child);
            //return redirect()->back();

            return response()->json(['redirect' => '/customers/'.$branch_id]);
        }
    }
    
    public function ajaxUpdate(Request $request, $branch_id) {
        $user = Sentinel::getUser();
        $record = $user->records()->where('branch_id', $branch_id)->first();
        $branch = $record->branch;

        $child = $branch->childs()->where('childs.id', $request->id)->first();

        $subscriber = $branch->subscribers();

        if($request->visit){
            $subscriber = $subscriber->where('type', '1')->get();
            foreach ($subscriber as $sub){
                $v = explode('-', $sub->visits);
                if($v[0] <= $request->visit && $v[1] >= $request->visit){
                    $subscriber = $sub;
                    break;
                }
            }
        }else{
            $subscriber = $subscriber->where('id', $request->sub_id)->first();
        }

        $company = $branch->company;
        $customers = $company->customers;

        $ch = [];
        foreach($customers as $cust){
            foreach($cust->childs as $chil)
            {
                $vis = $chil->visits;
                foreach ($vis as $vk){
                    $ch[] = $vk->number;
                }
            }
        }
        $num = empty($ch)? 1 : max($ch) +1;
        $child->visits()->create([
            'number' => str_pad($num, 5, '0', STR_PAD_LEFT),
            'subscriber_id' => $subscriber->id,
            'remainder' => $request->visit ? $request->visit : $subscriber->visits,
            'paid' => $request->paid,
            'valid' => $k = $subscriber->validity ? Carbon::now()->addMonth($subscriber->validity) : null,
        ]);
        return response()->json(['redirect' => '/customers/'.$branch_id]);
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
