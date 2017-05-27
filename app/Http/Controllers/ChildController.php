<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Sentinel;

class ChildController extends Controller
{

    public function decrease(Request $request)
    {
        $user = Sentinel::getUser();
        $record = $user->records()->where('branch_id', $request->branch_id)->first();
        $branch = $record->branch;

        $child = $branch->childs()->where('childs.id', $request->id)->first();//->where('id', $request->id)->first();
        $visit = $child->visits()->where('id', $request->visit_id)->first();
        //if(($child->visits->first()->valid >= $now || $child->visits->first()->valid == null) && $child->visits->first()->remainder >0)
        if(($visit->valid >= Carbon::now() || $visit->valid == null) && $visit->remainder >0){

        //if($visit->valid >= Carbon::now() && $visit->remainder >0){
            $visit->remainder -= 1;
            $visit->last_visit = Carbon::now()->todatestring();
            //$visit->last_visit = Carbon::createFromFormat('d/m/Y', Carbon::now());
            $visit->save();

            return response()->json(['decrease' => $visit]);
        }
    }

    public function search(Request $request)
    {
        $user = Sentinel::getUser();
        $record = $user->records()->where('branch_id', $request->branch_id)->first();
        $branch = $record->branch;
        $childs = $branch->childs();
        if($request->search){
            $childs = $childs
                ->where('child_name', 'LIKE', "%$request->search%");
        }
        if($request->min && $request->max){
            $max = Carbon::now()->subYears($request->max)->format("Y-m-d");
            $min = Carbon::now()->subYears($request->min)->format("Y-m-d");
            $childs = $childs
                ->where('age', '<=', $min)
                ->where('age', '>=', $max);
        }
        $sub1 = [];
        $sub2 = [];
        if($request->subscriber){
            foreach($childs->get() as $ch){
                if($ch->subscribers()
                    ->where('subscribers.id', $request->subscriber)->first()){
                    $sub1[] = $ch->id;
                }else{

                }
            }
        }
        if($request->status){
            if($request->status == 2){
                foreach($childs->get() as $chil){
                    if($chil->visits()
                        ->where('remainder', '0')
                        ->orWhere('valid', '<', Carbon::now())->first()){
                        $sub2[] = $chil->id;
                    }
                }
            }else{
                foreach($childs->get() as $chil){
                    if($chil->visits()
                        ->where([['valid', '>=', Carbon::now()], ['remainder', '>', '0']])
                        ->orWhere([['valid', null], ['remainder', '>', '0']])->first()){
                        $sub2[] = $chil->id;
                    }
                }
            }
        }
        //$ids = array_unique($subss, SORT_REGULAR);
        $ids = array_intersect($sub1, $sub2);

        if(!empty($ids)){
            $childs = $branch->childs()->whereIn('childs.id', $ids)->get();
        }else{
            $childs = $childs->get();
        }
        //return response()->json($childs);
        /*
       // $childs = DB::table('childs')
            ->join('child_subscriber', 'childs.id', '=', 'child_subscriber.child_id')
            ->join('subscribers', 'child_subscriber.subscriber_id', '=', 'subscribers.id')
            ->join('customers', 'childs.customer_id', '=', 'customers.id')
            ->join('branches', 'branches.id', '=', 'customers.branch_id')
            ->select(
                'childs.id',
                'childs.child_name',
                'childs.age',
                'childs.created_at',
                //'customers.id as parent_id',
                'customers.name',
                'customers.phone',
                'customers.post',
                'child_subscriber.id as subscriber_id',
                'child_subscriber.number',
                'child_subscriber.remainder',
                'child_subscriber.last_visit',
                'child_subscriber.valid',
                'subscribers.name as subscriber_name'
            )
            ->where('branches.id', $branch->id);*/




       // foreach($childs as $child){
           // $visits = $child->visits()->where()
       // }
        $data = '';
        $now = Carbon::now();
        $i = 1;
        foreach($childs as $child) {
            $data .= '<tr>' .
                '<td>' . $i . '</td>' .
                '<td><a href="'.env('APP_URL').'/customers/'.$branch->id.'/'.$child->id .'">' . $child->child_name . '</a><br><span style="font-size: 10px" class="pull-right">' . $child->customer->name . '</span></td>' .
                '<td>' . $child->customer->phone . ', <br>' . $child->customer->post . '</td>' .
                '<td>';
            foreach ($child->subscribers as $childSub) {
                $data .= ucfirst($childSub->name) . '<br>';
            }
            $data .= '</td>' .

                '<td id="visits_' . $child->id . '">';

            foreach ($child->visits as $child1) {
                $data .= '<span id="visits_' . $child1->id . '">' . ($child1->remainder != null ? $child1->remainder : "Неограниченное") . '</span><br>';
            }
            $data .= '</td>' .
                '<td id="valid_' . $child->id . '">';
            foreach ($child->visits as $child2) {
                $data .= '<span >' . ($child2->valid ? Carbon::parse($child2->valid)->format('d.m.Y') : 'Неограниченное') . '</span ><br >';
            }
            $data .= '</td>' .
                '<td>';
            foreach($child->visits as $child3) {
            //($child->last_visit ? Carbon::parse($child->last_visit)->format("d.m.Y") : "Не посещал") .
            $data .= '<span id="last_'. $child3->id .'">'. ($child3->last_visit ? Carbon::parse($child3->last_visit)->format("d.m.Y") : "Не посещал") .'</span><br>';
                    }
                    $data .= '</td>' .
                '<td item="'. $child->id .'">'.
                        '<button class="btn btn-info btn-xs"  onclick="actionVisitModal(this)"><i class="fa fa-scissors" aria-hidden="true"></i></button>&nbsp;'.

                        '<button class="btn btn-default btn-xs" onclick="actionShow(this)"><i class="fa fa-plus" aria-hidden="true"></i></button>&nbsp;<a href="#" class="btn btn-danger btn-xs"><i class="fa fa-trash" aria-hidden="true"></i></a>'.
                    '</td >' .
                '</tr >';
            $i++;
        }
        return response()->json($data);
    }
    public function update(Request $request){
        //
    }

    public function edit(Request $request)
    {
        $user = Sentinel::getUser();
        $record = $user->records()->where('branch_id', $request->branch_id)->first();
        $branch = $record->branch;
        $child = $branch->childs()->where('childs.id', $request->id)->first();

        $data = '<ol>';
        $now = Carbon::now();
        $i = 1;
        
        foreach ($child->visits as $visit){
            $data .= '<li><button data="' . $child->id . '-' . $visit->id . '" class="btn btn-info '.((($visit->valid >= $now || $visit->valid == null) && $visit->remainder > 0) ? '' : 'disabled' ).'"  onclick="actionVisit(this)">'. $visit->subscriber->name .'</button></li>';
        }
            $data .= '<ol>';
        return response()->json($data);
    }
}
