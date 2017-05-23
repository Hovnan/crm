<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Invitation;
use Sentinel;
use Mail;

class InvitationController extends Controller
{
    public function store(Request $request)
    {
        $user = Sentinel::getUser();

            /*if(!$this->validate($request, ['email' => 'required|email'])){
                return response()->json([$this->errors->all()], 500);
            }*/
        //dd($request->branch_id);
       // $branch = Branch::find($request->branch_id);
        $record = $user->records()->where('branch_id', $request->branch_id)->first();
        //$record = $request->branch_id ? $user->records()->where('branch_id', $request->branch_id)->first() : false;

        //$br = $record ? $record : $user->records()->first();
        $branch = $record? $record->branch : false;
        //dd($record->branch);
        if(!$branch){
            return redirect()->back();//withmessage no branch by that id
        }
        $this->validate($request, [
            'email' => 'required|email'
        ]);
        $code = md5(microtime() . rand(0, 9999));
        //$user = User::byEmail($request->email);
        //if($user->branches()->where('id', $branch_id)) return false
        $invitation = Invitation::byEmail($request->email);
        if($invitation) {
            if ($invitation->informations()->where('branch_id', $branch->id)->first()) {
                return redirect()->back(); //session bflash by that branch id invite already sented
            }
        }

        if (!$invitation)
        {
            $invitation = Invitation::create([
                'email' => $request->email,
            ]);
        }
       // else {
        $data= $request->permission ? $request->permission : [];
        //dd($request->permission );
            $record = $invitation->informations()->create([
                'branch_id' => $branch->id,
                'token' => $code,
                'role' => $request->role,
                'permissions' => $data,
            ]);
        //}

        $this->sendEmail($invitation, $code);
        return redirect()->back();//withmessage invite was created
        //return redirect()->back(); //withMessage you are already invite this person to your filial

        //return response()->json(['redirect' => 'dashboard']);
    }
/*
    public function update(Request $request, $id)
    {
       /* //$user = Sentinel::getUser();
        $user = Invitation::find($id);
        if($request->email != $user->email){
            $this->validate($request, [
                'email' => 'required|email'
            ]);
        }

        //if($user->)


        $record = $user->records()->where('branch_id', $request->branch_id)->first();

        $branch = $record? $record->branch : false;

        if(!$branch){
            return redirect()->back();//withmessage no branch by that id
        }
        $this->validate($request, [
            'email' => 'required|email'
        ]);
        $code = md5(microtime() . rand(0, 9999));

        $invitation = Invitation::byEmail($request->email);
        if($invitation) {
            if ($invitation->informations()->where('branch_id', $branch->id)->first()) {
                return redirect()->back(); //session bflash by that branch id invite already sented
            }
        }

        if (!$invitation)
        {
            $invitation = Invitation::create([
                'email' => $request->email,
            ]);
        }

        $data= $request->permission ? $request->permission : [];
        $record = $invitation->informations()->create([
            'branch_id' => $branch->id,
            'token' => $code,
            'role' => $request->role,
            'permissions' => $data,
        ]);


        $this->sendEmail($invitation, $code);
        return redirect()->back();

    }*/



    private function sendEmail ($invitation, $code)
    {
        Mail::send('emails.activation-admin', [
            'user' => $invitation,
            'code' => $code
        ], function ($message) use ($invitation) {
            $message->to($invitation->email);
            $message->subject("Hello Future, activate your account.");
        });
    }


}
