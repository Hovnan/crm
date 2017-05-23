<?php

namespace App\Http\Controllers;

use App\Branch;
use Illuminate\Http\Request;
use Activation;
use Sentinel;
use Session;
use App\User;
use App\Invitation;

class ActivationController extends Controller
{
    
    //public function getActivate ($id, $code)
    public function getActivate ($id, $code)
    {
        $invitation = Invitation::find($id);
        $inform = $invitation->informations()->where('token', $code)->first();
        //can use $inviter->branch_id and delete function variable br...
        if(!$inform){
            return redirect('/');
        }
        if($user = User::byEmail($invitation->email)) {
            if (!$user->records()->where('branch_id', $inform->branch_id)->first()) {
                $record = $user->records()->create([
                    'branch_id' => $inform->branch_id,
                    'role' => $inform->role,
                    'permissions' => $inform->permissions,
                ]);
                $inform->delete();
                if (!$invitation->informations()->first()) {
                    $invitation->delete();
                }
                return redirect()->route('dashboard.profile', ['branch' => $record->branch_id]);//redirect admin or manager profile
            }
            return redirect('/');//Session flash message also atach same branch
        }

        return view('authentication.password')->withUser($invitation)->withInform($inform);//->withBranch($branch_id);
    }

    public function postActivate (Request $request, $id, $code)
    {
        $invitation = Invitation::find($id);
        $inform = $invitation->informations()->where('token', $code)->first();
        if(!$inform){
            return redirect('/');
        }
        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'password' => 'required | min:6 | confirmed',
            'password_confirmation' => 'required'
        ]);
        //$branch = Branch::find($branch_id);
//if($branch)
        //if (!$user->records()->where('branch_id', $inform->branch_id)->first()) {
        $token = md5(microtime() . rand(0, 9999));
        $user = Sentinel::registerAndActivate([
            'email' => $invitation->email,
            //'role' => $invitation->role,
            'password' => $request->password,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'token' => $token,
            //'permissions' => $invitation->permissions
        ]);
        $record = $user->records()->create([
            'branch_id' => $inform->branch_id,
            'role' => $inform->role,
            'permissions' => $inform->permissions,
        ]);
        $inform->delete();
        if (!$invitation->informations()->first()) {
            $invitation->delete();
        }

        Session::put('token_response', $token);
            //$admin->branches()->attach($branch->id);
        if(Sentinel::authenticate([
            'email' => $invitation->email,
            'password' => $request->password
        ])) {
            //return $invite->role[$branch->id];
            return redirect()->route('dashboard.profile', ['branch' => $record->branch_id]);//redirect admin or manager profile

        }
    }
}
