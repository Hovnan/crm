<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Activation;
use Sentinel;
use Session;
use Validator;
use Mail;

class RegistrationController extends Controller
{
    
    protected $code;
    protected $user;

    public function postRegister (Request $request)
    {
        /*$this->validate($request, [
            'email' => 'required|email|unique:users'
        ]);*/
        $mail = $request->email;

        return view('register.register-one')->withMail($mail);
    }
    
    public function getRegister ()
    {
        $mail='';
        return view('register.register-one')->withMail($mail);
    }
    
    public function postRegisterOne (Request $request)
    {
        $this->validate($request, [
            'email' => 'email|unique:users|required',
            'password' => 'required | min:6 | confirmed',
            'password_confirmation' => 'required',
        ]);
        Session::put('k', $request->password);
        $user = Sentinel::register($request->all());

        Activation::create($user);

        $code = mt_rand(100000, 999999);
        $user->confirmation()->create([
            'token' => $code
        ]);
        $token = md5(microtime() . rand(0, 9999));
        $user->token = $token;
        
        $user->save();

        Session::put('token_response', $token);
        $this->sendEmail($user, $code);

        return redirect()->route('register-2', ['id' => $user->id]);

    }
    public function getRegisterTwo ($id)
    {
        $user = Sentinel::findById($id);
        if ($activation = Activation::exists($user))
        {
            return view('register.register-two')->withUser($user)->withCode($activation->code);
        }
        else{
            return redirect('/');
        }

    }
    public function somethingElseIsInvalid(){
        //$user = Sentinel::findById($id);
        if($this->user->confirmation->token != $this->code){
            return true;
        }
        return false;
    }
    public function postRegisterTwo (Request $request, $id)
    {
       // $user = Sentinel::findById($id);
        $this->code = $request->code;
        $this->user = Sentinel::findById($id);

        $validator = Validator::make($request->all(), [
            'code' => 'required|digits:6',
            //'code' => 'min:2',
        ]);
        $validator->after(function ($validator) {
            if ($this->somethingElseIsInvalid()) {
                $validator->errors()->add('code', $this->user);
            }
        });


        if ($validator->fails()) {

            //$validator->errors()->add('code', 'Something is wrong with this field!');
            return redirect()->back()
                //->withErrors($validator)
                ->withErrors($validator)
                ->withInput();
        }

        /*$this->validate($request, [
            'code' => 'required|min:6|max:6'
        ]);*/
        else{
            //return 'PostTwo';
            $activation = Activation::exists($this->user);
            if(Activation::complete($this->user, $activation->code)){

                $this->user->confirmation()->delete();

                return redirect()->route('register-3', ['id' => $id]);
            }
            
        }
        return redirect()->back();

    }
    public function getRegisterThree ($id)
    {
        //return 'Three';
        
        $user = Sentinel::findById($id);
        return view('register.register-three')->withUser($user);
    }
    public function postRegisterThree (Request $request, $id)
    {
        $this->validate($request, [
            'first_name' => 'required|min:2|max:55',
            'last_name' => 'required|min:2|max:55',
        ]);
        $user = Sentinel::findById($id);
        
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        
        $user->save();
        
        return redirect()->route('register-4', ['id' => $id]);
    }

    public function getRegisterFour ($id)
    {
        $user = Sentinel::findById($id);
        return view('register.register-four')->withUser($user);
    }
    
    public function postRegisterFour (Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|min:2|max:55',
            'domain' => 'required|min:2|max:55',
        ]);
        $user = Sentinel::findById($id);

        $company = $user->companies()->create([
            'name' => $request->name,
            'domain' => 'sub'.$request->name,
        ]);

        if(Sentinel::authenticate([
            'email' => $user->email,
            'password' => Session::get('k'),
        ]))
        {
            Session::forget('k');
            return redirect()->route('dashboard.show');
        }

        return redirect('/');
    }




    private function sendEmail ($user, $code)
    {
        Mail::send('emails.ownersActivation', [
            'user' => $user,
            'code' => $code
        ], function ($message) use ($user) {
            $message->to($user->email);
            $message->subject("Hello Owner, activate your account.");
        });
    }
    /*
private function sendEmail ($user, $code)
    {
        Mail::send('emails.activation', [
            'user' => $user,
            'code' => $code
        ], function ($message) use ($user) {
            $message->to($user->email);
            $message->subject("Hello $user->first_name, activate your account.");
        });
    }
     public function register ()
     {
         return view('authentication.register');
     }
    
    public function postRegister (Request $request)
    {
        //$user = Sentinel::registerAndActivate($request->all());
        $user = Sentinel::register($request->all());
        $activation = Activation::create($user);
        //$role = Sentinel::findRoleById();
        $role = Sentinel::findRoleBySlug('owner');
        $role->users()->attach($user);
        $this->sendOwnerEmail($user, $activation->code);
        //return redirect()->route('register.3', []);
        return redirect('/login');
    }*/

    
    
    /*public function destroy ($id)
    {

        $user = Sentinel::findById($id);
        //dd($user);

      $user->delete();

    }*/
}
