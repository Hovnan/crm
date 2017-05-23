<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Reminder;
use Sentinel;
use Session;
use Mail;

class ForgotPasswordController extends Controller
{
    public function forgotPassword ()
    {
        return view('authentication.forgot-password');
    }

    public function postForgotPassword (Request $request)
    {
        $user = User::whereEmail($request->email)->first();
		if(count($user) == 0){
            abort(404);
        }
        //$sentinelUser = Sentinel::findById($user->id);
        //dd(count($user));
       /* if(count($user) == 0){
            return redirect()->back()->with(['success' => 'Reset code Was sent to your email.']);
        }*/
        $reminder = Reminder::exists($user)?: Reminder::create($user);
        $this->sendEmail($user, $reminder->code);
        return redirect()->back()->with(['success' => 'Код сброса Был отправлен на ваш адрес электронной почты.']);
    }

    private function sendEmail ($user, $code)
    {
        Mail::send('emails.forgot-password', [
            'user' => $user,
            'code' => $code
        ], function ($message) use ($user) {
            $message->to($user->email);
            $message->subject("Hello $user->first_name, reset your password.");
        });
    }

    public function resetPassword ($email, $resetCode)
    {
        $user = User::byEmail($email);
        if(count($user) == 0){
            abort(404);
        }
        //$sentinelUser = Sentinel::findById($user->id);

        if($reminder = Reminder::exists($user)) {
            if($resetCode == $reminder->code) {
                return view('authentication.reset-password');
            }else{
                return redirect('/');
            }
        }else{
            return redirect('/');
        }
    }

    public function postResetPassword (Request $request, $email, $resetCode)
    {
        $this->validate($request, [
            'password' => 'confirmed|required|min:6|max:10',
            'password_confirmation' => 'required|min:6|max:10',
        ]);
        $user = User::byEmail($email);
        //dd($user);
        if(count($user) == 0){
            abort(404);
        }
        //$sentinelUser = Sentinel::findById($user->id);

        if($reminder = Reminder::exists($user)) {
            if($resetCode == $reminder->code) {
                Reminder::complete($user, $resetCode, $request->password);
                Session::put('token_response', $user->token);
                return redirect('/login')->with('success', 'Пожалуйста войдите вводя ваш новый пароль');
            }else{
                return redirect('/');
            }
        }else{
            return redirect('/');
        }
    }
}
