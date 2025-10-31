<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\User;
use App\Http\Requests\Authentication\SignupRequest;
use App\Http\Requests\Authentication\SigninRequest;
use Illuminate\Support\Facades\Hash;
use Exception;

class AuthenticationController extends Controller
{
    public function signUpForm(){
        return view('authentication.register');
    }
    public function signUpStore(SignupRequest $request){
        try{
            // dd($request->all());
            $user=new User;
            $user->name=$request->FullName;
            $user->contact_no=$request->contact_no;
            $user->email=$request->EmailAddress;
            $user->password=Hash::make($request->password);
            $user->status = 1;
            $user->role_id=1;
            if($user->save())
                return redirect()->route('login')->with('success','Successfully Registred');
            else
                return redirect()->route('login')->with('danger','Please try again');
        }catch(Exception $e){
            dd($e);
            return redirect()->route('login')->with('danger','Please try again');
        }
    }
    public function signInForm(){
        return view('authentication.login');
    }
    public function signInCheck(SigninRequest $request){
        try{
            // dd($request->all());
            $user=User::where('contact_no',$request->username)
                        ->orWhere('email',$request->username)->first();
            if($user){
                if($user->status==1){
                    if(Hash::check($request->password , $user->password)){
                        $this->setSession($user);
                        $this->notice::success('Successfully login');
                        return redirect()->route('dashboard');
                    }else
                        $this->notice::error('phone number or password is wrong!');
                        return redirect()->route('login');
                }else
                    $this->notice::error('You are not active user. Please contact to authority!');
                    return redirect()->route('login');
        }else
                $this->notice::error('phone number or password is wrong!');
                return redirect()->route('login');
        }catch(Exception $e){
            dd($e);
            $this->notice::error('phone number or password is wrong!');
            return redirect()->route('login');
        }
    }

    public function setSession($user){
        return request()->session()->put([
                'userId'=>encryptor('encrypt',$user->id),
                'userName'=>encryptor('encrypt',$user->name),
                'email'=>encryptor('encrypt',$user->email),
                'role_id'=>encryptor('encrypt',$user->role_id),
                'accessType'=>encryptor('encrypt',$user->full_access),
                'role'=>encryptor('encrypt',$user->role->name),
                'roleIdentity'=>encryptor('encrypt',$user->role->identity),
                'language'=>encryptor('encrypt',$user->language),
                'Contact'=>encryptor('encrypt',$user->contact_no_en),
                'image'=>$user->image ?? 'no-image.png',
                'image'=>$user->teacher?->image,
            ]
        );
    }

    public function signOut(){
        request()->session()->flush();
        return redirect()->route('login')->with('danger','Succfully Logged Out');
    }
    public function show(User $data)
    {
        return view('backend.user.profile', compact('data')); 
    }
}