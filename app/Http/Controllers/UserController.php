<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Company;
use App\User;
use Sentinel;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = Sentinel::getUser();
        //$user-companies;
        $role = $user->roles()->first()->slug;
        //dd($user);
        //$parent = $user->parent == 0 ? $user->id : $user->parent;

        //$companies = Company::whereUser_id($parent)->get();//????
        $company = Company::find($id);
        //$companies
//dd($user);
/*foreach ($user->companies as $company){
    dd($company);
}
        die;*/
       // dd($company);

       // if($id == $user->id)
       // {
            return view('users.profile')->withUser($user)->withCompany($company)->withRole($role);
        //}
        //else{
            //return redirect('/');
        //}
        //$user = Sentinel::findById();


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {


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
       // dd('777');
        $user = Sentinel::getUser();
        if($user->id != $id){
            return redirect()->back();
        }
        //echo $user->password;
        //dd(bcrypt($request->old_password));
       // if (bcrypt($request->old_password) == $user->password)
        //{
            //dd('equal');
            $this->validate($request, [
                'first_name' => 'required|min:2|max:55',
                'last_name' => 'required|min:2|max:55',
                //'password' => 'required | min:6 | confirmed',
               // 'password_confirmation' => 'required'
            ]);
        if($user->email != $request->email){
            $this->validate($request, [
                'email' => 'required|email|unique:users',
            ]);
        }

        $new  = User::find($id);

        $new->first_name= $request->first_name;
        $new->last_name= $request->last_name;
        $new->email= $request->email;

        $new->save();
        return redirect()->back();
       // }
       // else
        //{
        //    echo '77';
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
