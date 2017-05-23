<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Invitation;
use App\Branch;
use Mail;

class HelperController extends Controller
{
    /*public function store (Request $request)
    {
        $branch = Branch::find($request->branch_id);
        if(!$branch){
            return redirect()->back();//withmessage no branch by that id
        }
        $this->validate($request, [
            'email' => 'required|email'
        ]);
        $code = md5(microtime() . rand(0, 9999));
        if (!$invitation = Invitation::byEmail($request->email))
        {
            $invitation = Invitation::create([
                'email' => $request->email,
            ]);
        }
        else {
            $record = $invitation->records()->create([
                'branch_id' => $branch->id,
                'token' => $code,
                'role' => $request->role,
                'permissions' => $request->permission,
            ]);
        }

        $this->sendEmail($invitation, $branch->id, $code);
        return redirect()->route('dashboard.show', ['branch' => $branch->id]); //withMessage you are already invite this person to your filial
    }

    private function sendEmail ($admin, $branch_id, $code)
    {
        Mail::send('emails.activation-admin', [
            'user' => $admin,
            'branch_id' => $branch_id,
            'code' => $code
        ], function ($message) use ($admin) {
            $message->to($admin->email);
            $message->subject("Hello Future, activate your account.");
        });
    }*/
}
