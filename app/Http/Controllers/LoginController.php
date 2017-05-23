<?php

namespace App\Http\Controllers;

use App\Invitation;
use App\User;
use Illuminate\Http\Request;
use Cartalyst\Sentinel\Checkpoints\ThrottlingException;
use Cartalyst\Sentinel\Checkpoints\NotActivatedException;
use Sentinel;
use Session;

class LoginController extends Controller
{

    public function login ()
    {
        if (Session::has('token_response')){
            $user = User::whereToken(Session::get('token_response'))->first();
            //dd(Session::get('token_response'));
            $invite = Invitation::byEmail($user->email);
            return view('authentication.logo-login')->withUser($user)->withInvite($invite);
        }
        
        return view('authentication.login');
    }

    public function loginForget (){

        if(Session::has('token_response')){
            Session::forget('token_response');
        }

        return redirect()->route('login');
    }
    
    public function postEmail (Request $request)
    {
        //return 'postEmail';
        $this->validate($request, [
           'email' => 'required|email' 
        ]);
        $invite = Invitation::byEmail($request->email);
        //dd($invite->informations()->first());
        if($user = User::byEmail($request->email))
        {
            return view('authentication.logo-login')->withUser($user)->withInvite($invite);
        }
        elseif($invite)
        {
            return view('authentication.confirm')->withInvite($invite);
        }
        else
        {
            return redirect('/');
        }
    }
    public function postLogin (Request $request, $branch_id = null)
    {
        try{
            $rememberMe = false;
            if(isset($request->remember_me)){
                $rememberMe = true;
            }

            if(Sentinel::authenticate($request->all(), $rememberMe)){

                return response()->json(['redirect' => $branch_id ? '/dashboard/'.$branch_id : '/dashboard']);
                
            }else{
                // return redirect()->back()->with(['error' => 'Wrong credentials']);
                return response()->json(['error' => 'Wrong credentials'], 500);
            }
        }catch(ThrottlingException $e){
            $delay = $e->getDelay();
            return response()->json(['error' => "You are banned for $delay seconds."], 500);
        }catch(NotActivatedException $e){
            // retrun redirect()->route('you must activate your account')->withEmai($user->email);
            return response()->json(['error' => "Your account is not activated."], 500);
        }


        // Sentinel::authenticate($request->all());

        //else()
        //return Sentinel::check();
    }
/*
    public function postLoginiiiiin (Request $request)
    {
        try{
            $rememberMe = false;
            if(isset($request->remember_me)){
                $rememberMe = true;
            }

            if(Sentinel::authenticate($request->all(), $rememberMe)){
                //$slug = Sentinel::getUser()->roles()->first()->slug;
                $user = Sentinel::getUser();
                if($user->role[$user->id] == 'admin'){
                    //return redirect('/earnings');
                    return response()->json(['redirect' => '/earnings']);
                }
                elseif ($user->role[$user->id] == 'manager'){
                    //return redirect('/tasks');
                    return response()->json(['redirect' => '/tasks']);
                }
                /*elseif ($user->role[$user->id] == 'owner'){
                    //return response()->json(['redirect' => '/dashboard']);
                    return response()->json(['redirect' => "/owner/{{ $user->companies()->first()->id }}"]);
                }
                elseif ($user->companies){
                    
                    //return response()->json(['error' => $user->companies], 500);
                    //return redirect('');
                    return response()->json(['redirect' => '/owner']);
                }
            }else{
               // return redirect()->back()->with(['error' => 'Wrong credentials']);
                return response()->json(['error' => 'Wrong credentials'], 500);
            }
        }catch(ThrottlingException $e){
            $delay = $e->getDelay();
            return response()->json(['error' => "You are banned for $delay seconds."], 500);
        }catch(NotActivatedException $e){
            // retrun redirect()->route('you must activate your account')->withEmai($user->email);
            return response()->json(['error' => "Your account is not activated."], 500);
        }


       // Sentinel::authenticate($request->all());

        //else()
        //return Sentinel::check();
    }*/

    public function logout ()
    {
        Sentinel::logout();
        return redirect('/login');
    }
}
