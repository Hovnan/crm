<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employee;
use Sentinel;
use Validator;



class EmployeeController extends Controller
{
    protected $active = 'employees';
    protected $social = [
        'i-1' => '<i class="fa fa-vk" aria-hidden="true"></i>',
        'i-2' => '<i class="fa fa-facebook" aria-hidden="true"></i>',
        'i-3' => '<i class="fa fa-instagram" aria-hidden="true"></i>',
        'i-4' => '<i class="fa fa-twitter" aria-hidden="true"></i>',
        'i-5' => '<i class="fa fa-odnoklassniki" aria-hidden="true"></i>'
    ];
    protected $designation = [
        '1' => 'Менеджер',
        '2' => 'Тренер',
    ];
    protected $schedule = [
        '1' => 'Помесячный',
        '2' => 'Посуточный',
        '3' => 'За выход',
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
        $company = $branch->company;
        return view('employees.index', [
            'user' => $user,
            'social' => $this->social,
            'record' => $record,
            'branch' => $branch,
            'company' => $company,
            'designation' => $this->designation,
            'schedule' => $this->schedule,
            'employees' => $employees,
            'active' => $this->active
        ]);

    }

    public function search(Request $request, $branch_id)
    {
        $user = Sentinel::getUser();
        $record = $user->records()->where('branch_id', $branch_id)->first();
        $branch = $record->branch;
        $company = $branch->company;
        $employees = $branch->employees();
        if($request->search_designation){
            $employees = $employees->where('designation', $request->search_designation);
        }
        if($request->search_schedule){
            $employees = $employees->where('schedule', $request->search_schedule);
        }
        if($request->search){
            $employees = $employees->where('name', 'LIKE', "%$request->search%")
                                    ->orWhere('phone', 'LIKE', "%$request->search%");
        }
        $employees = $employees->get();
        $request->flash();
        
        return view('employees.index', [
            'user' => $user,
            'social' => $this->social,
            'record' => $record,
            'branch' => $branch,
            'company' => $company,
            'employees' => $employees,
            'designation' => $this->designation,
            'schedule' => $this->schedule,
            'active' => $this->active
        ]);

    }

    public function searchAjax(Request $request)
    {
        $user = Sentinel::getUser();
        $record = $user->records()->where('branch_id', $request->branch_id)->first();
        $branch = $record->branch;
        $employees = $branch->employees();
        //$company = $branch->company;
        //$subscribers = $branch->subscribers;

        if($request->search_designation){
            $employees = $employees->where('designation', $request->search_designation);
        }
        if($request->search_schedule){
            $employees = $employees->where('schedule', $request->search_schedule);
        }
        if($request->search){
            $employees = $employees->where('name', 'LIKE', "%$request->search%")
                ->orWhere('phone', 'LIKE', "%$request->search%");
        }
        $employees = $employees->get();
        $data = '';

        foreach ($employees as $employee){

            $data .= '<tr>'.
                        '<td>'. $employee->id .'</td>'.
                        '<td>'. $employee->name .'</td>'.
                        '<td>'. $employee->post.', '.$employee->phone .'</td>'.
                        '<td>'. $this->designation[$employee->designation] .'</td>'.
                        '<td>'. $this->schedule[$employee->schedule] .'</td>'.
                        '<td>'. $employee->holiday.', '.$employee->hospital .'</td>'.
                        '<td>'. $employee->salary .'</td>'.
                        '<td></td>'.
                    '</tr>';
        }
        //return response()->json($data);
        return response()->json($data);
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
            'address' => 'required',
            'dob' => 'required|date',
            //'social' => 'url',
            'designation' => 'required|numeric',
            'working' => 'required|numeric',
            'holiday' => 'required|numeric',
            'hospital' => 'required|numeric',
            'schedule' => 'required|numeric',
            'salary' => 'required|numeric',
        ]);

        if ($validator->fails()) {

            return response()->json(['errors' => $validator->errors()], 500 );

        }else{
            $user = Sentinel::getUser();
            $record = $user->records()->where('branch_id', $branch_id)->first();
            $branch = $record->branch;
            $employee = $branch->employees()->create([
                'name' => $request->name,
                'phone' => $request->phone,
                'post' => $request->post,
                'address' => $request->address,
                'dob' => $request->dob,
                'social' => $request->social ? $request->social : [],
                'designation' => $request->designation,
                'working' => $request->working,
                'holiday' => $request->holiday,
                'hospital' => $request->hospital,
                'schedule' => $request->schedule,
                'salary' => $request->salary,
            ]);
            //session answer with success

            return response()->json(['redirect' => '/employees/'.$branch_id]);
        
        }

       // return redirect()->back();
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
        $employee = $branch->employees()->where('id', $id)->first();
        $company = $branch->company;
        return view('employees.edit', [
            'user' => $user,
            'social' => $this->social,
            'record' => $record,
            'branch' => $branch,
            'company' => $company,
            'schedule' => $this->schedule,
            'designation' => $this->designation,
            'employee' => $employee,
            'active' => $this->active
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
            'address' => 'required',
            'dob' => 'required|date',
            //'social' => 'url',
            'designation' => 'required|numeric',
            'working' => 'required|numeric',
            'holiday' => 'required|numeric',
            'hospital' => 'required|numeric',
            'schedule' => 'required|numeric',
            'salary' => 'required|numeric'
        ]);
        if ($validator->fails()) {

            return response()->json(['errors' => $validator->errors()], 500 );

        }else{
            $user = Sentinel::getUser();
            $record = $user->records()->where('branch_id', $branch_id)->first();
            $branch = $record->branch;

            $employee = $branch->employees()->where('id', $id)->first();

            $employee->name = $request->name;
            $employee->phone = $request->phone;
            $employee->post = $request->post;
            $employee->address = $request->address;
            $employee->dob = $request->dob;
            $employee->social = $request->social ? $request->social : [];
            $employee->designation = $request->designation;
            $employee->working = $request->working;
            $employee->holiday = $request->holiday;
            $employee->hospital = $request->hospital;
            $employee->schedule = $request->schedule;
            $employee->schedule = $request->schedule;
            $employee->salary = $request->salary;

            $employee->save();

            /*$employee = $branch->employees()->where('id', $id)->update([
                'name' => $request->name,
                'phone' => $request->phone,
                'post' => $request->post,
                'address' => $request->address,
                'dob' => $request->dob,
                'social' => $request->social ? $request->social : [],
                'designation' => $request->designation,
                'working' => $request->working,
                'holiday' => $request->holiday,
                'hospital' => $request->hospital,
                'schedule' => $request->schedule,
                'salary' => $request->salary,
            ]);*/
            //session answer with success

            return response()->json(['redirect' => '/employees/'.$branch_id]);
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
