<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Training;
use Validator;
use Sentinel;

class TrainingController extends Controller
{
    protected $active = 'trainings';
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
        $directs = $branch->directions;
        $employees = $branch->employees;
        $trainings = $branch->trainings;
       // dd($trainings);
        $company = $branch->company;

        return view('trainings.index', [
            'user' => $user,
            'record' => $record,
            'branch' => $branch,
            'company' => $company,
            'active' => $this->active,
            'directs' => $directs,
            'trainings' => $trainings,
            'employees' => $employees
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
            'direction_id' => 'required|numeric',
            'name' => 'required|unique:trainings',
            'duration' => 'required|numeric',
            'age' => 'required|numeric',
            'amount' => 'required|numeric',
            'cost' => 'required|numeric',
            'employees' => 'required'
        ]);
        if ($validator->fails()) {

            return response()->json(['errors' => $validator->errors()], 500 );

        }else{
            $user = Sentinel::getUser();
            $record = $user->records()->where('branch_id', $branch_id)->first();
            $branch = $record->branch;
            $directions = $branch->directions()->where('id', $request->direction_id)->first();

            $training = $directions->trainings()->create([
                'name' => $request->name,
                'duration' => $request->duration,
                'age' => $request->age,
                'amount' => $request->amount,
                'cost' => $request->cost,
            ]);

            $training->employees()->attach($request->employees);
            //session answer with success

            return response()->json(['redirect' => '/trainings/'.$branch_id]);
            //return response()->json($trainings);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show (Request $request, $branch_id)
    {
        $user = Sentinel::getUser();
        $record = $user->records()->where('branch_id', $branch_id)->first();
        $branch = $record->branch;
        $trainings = $branch->trainings()->where('trainings.id', $request->id)->first();
        $data = '';

        $data .= '<div class="col-md-6" >'.
                    '<div class="form-group" id="employee_id">'.
                        '<label for="emp">Тренер *</label>'.
                        '<select class="selectpicker" data-style="btn-default btn-sel" multiple data-max-options="10" name="employee_id" id="emp">'.
                            '<option value="">Select Trainer</option>';
                                foreach($trainings->employees as $employee){
                                    $data .= '<option value="'. $employee->id .'">'. $employee->name .'</option>';
                                }
                        $data .= '</select>'. 
                            '<span class="help-block"></span>'. 
                            '</div>'. 
                            '</div>'.
                            '<div class="clearfix"> </div>';


        return response()->json($data);

    }

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
        $training = $branch->trainings()->where('trainings.id', $id)->first();
        $employees = $branch->employees;
        
        return view('trainings.edit', [
            'user' => $user,
            'record' => $record,
            'branch' => $branch,
            'employees' => $employees,
            'company' => $company,
            'active' => $this->active,
            'training' => $training
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
            'duration' => 'required',
            //'days' => 'required',
            'age' => 'required|numeric',
            'amount' => 'required|numeric',
            'cost' => 'required|numeric',
            'employee_id' => 'required|numeric'
        ]);
        if($request->old_name != $request->name){
            $validator = Validator::make($request->all(), [
                'name' => 'required|unique:trainings'
            ]);
        }
        if ($validator->fails()) {

            return response()->json(['errors' => $validator->errors()], 500 );

        }else{
            $user = Sentinel::getUser();
            $record = $user->records()->where('branch_id', $branch_id)->first();
            $branch = $record->branch;
            $employee = $branch->employees()->where('id', $request->employee_id)->first();

            $training = Training::where('id', $id)->update([
                'name' => $request->name,
                'duration' => $request->duration,
                //'days' => $request->days,
                'age' => $request->age,
                'amount' => $request->amount,
                'cost' => $request->cost,
                'employee_id' => $employee->id
            ]);
            /*$training = Training::find($id);

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
            //return response()->json(['errors' => $employee], 500 );
            return response()->json(['redirect' => '/trainings/'.$branch_id]);
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
