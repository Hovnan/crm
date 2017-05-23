<?php

namespace App\Http\Controllers;

use App\Timetable;
use Illuminate\Http\Request;
use Validator;
use Sentinel;

class TimetableController extends Controller
{
    
    protected $active = 'timetables';
    protected $week = [
        1 => 'Понедельник',
        2 => 'Вторник',
        3 => 'Среда',
        4 => 'Четверг',
        5 => 'Пятница',
        6 => 'Суббота',
        7 => 'Воскресенье'
    ];
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
        $employees = $branch->employees;
        $trainings = $branch->trainings;
        //$trainings
        $timetables = $branch->timetables;
        $company = $branch->company;
        return view('timetables.index', [
            'week' => $this->week,
            'user' => $user,
            'record' => $record,
            'branch' => $branch,
            'company' => $company,
            'employees' => $employees,
            'trainings' => $trainings,
            'active' => $this->active,
            'timetables' => $timetables
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
            'day' => 'required',
            'time' => 'required',
            'training_id' => 'required|numeric',
            'employee_id' => 'required|numeric'
        ]);
        if ($validator->fails()) {

            return response()->json(['errors' => $validator->errors()], 500 );

        }else{
            $user = Sentinel::getUser();
            $record = $user->records()->where('branch_id', $branch_id)->first();
            $branch = $record->branch;
            $timetable = $branch->timetables()->create([
                'day' => $request->day,
                'time' => $request->time,
                'training_id' => $request->training_id,
                'employee_id' => $request->employee_id,
            ]);
            //session answer with success

            return response()->json(['redirect' => '/timetables/'.$branch_id]);

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
        $employees = $branch->employees;
        $trainings = $branch->trainings;
        $timetable = $branch->timetables()->where('timetables.id', $id)->first();
        $company = $branch->company;
        return view('timetables.edit', [
            'week' => $this->week,
            'user' => $user,
            'record' => $record,
            'branch' => $branch,
            'company' => $company,
            'employees' => $employees,
            'trainings' => $trainings,
            'active' => $this->active,
            'timetable' => $timetable
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
            'day' => 'required',
            'time' => 'required',
            'training_id' => 'required|numeric',
            'employee_id' => 'required|numeric'
        ]);

        if ($validator->fails()) {

            return response()->json(['errors' => $validator->errors()], 500 );

        }else{
            $user = Sentinel::getUser();
            $record = $user->records()->where('branch_id', $branch_id)->first();
            $branch = $record->branch;
            $employee = $branch->employees()->where('id', $request->employee_id)->first();

            //$timetable = $branch->timetables()->create([
            $timetable = Timetable::find($id);
                $timetable->day = $request->day;
                $timetable->time = $request->time;
                $timetable->training_id = $request->training_id;
                $timetable->employee_id = $request->employee_id;
            $timetable->save();

           // $employee = $branch->employees()->where('id', $request->employee_id)->first();

           /* $training = Training::where('id', $id)->update([
                'name' => $request->name,
                'duration' => $request->duration,
                //'days' => $request->days,
                'age' => $request->age,
                'amount' => $request->amount,
                'cost' => $request->cost,
                'employee_id' => $employee->id
            ]);
            $training = Training::find($id);

            $training->name = $request->name;
            $training->duration = $request->duration;
            //$training->days = $request->days;
            $training->age = $request->age;
            $training->amount = $request->amount;
            $training->cost = $request->cost;
            $training->employee_id = $request->employee_id;

            $training->save();*/

            /*$training = $employee->trainings()->where('id', $id)->update([
                'name' => $request->name,
                'duration' => $request->duration,
                'days' => $request->days,
                'age' => $request->age,
                'amount' => $request->amount,
                'cost' => $request->cost,
            ]);*/
            //session answer with success
            return response()->json(['redirect' => '/timetables/'.$branch_id]);
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
