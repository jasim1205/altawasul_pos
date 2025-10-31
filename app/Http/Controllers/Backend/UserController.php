<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Requests\Backend\User\AddNewRequest;
use App\Http\Requests\Backend\User\UpdateRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use File;
use Exception;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user=User::paginate(10);
        return view('backend.user.index',compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $role=Role::get();
        return view('backend.user.create',compact('role'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        try{
            $data=new User();
            $data->name=$request->name;
            $data->email=$request->email;
            $data->contact_no=$request->contact_no;
            $data->role_id=1;
            $data->status=$request->status;
            $data->full_access=1;
            $data->password=Hash::make($request->password);
            $data->remember_token = Str::random(60);
            if($request->hasFile('image')){
                $imageName = rand(111,999).time().'.'.$request->image->extension();
                $request->image->move(public_path('uploads/users'), $imageName);
                $data->image=$imageName;
            }
// dd($data);
            if($data->save()){
                $this->notice::success('Successfully saved');
                return redirect()->route('user.index');
            }
        }catch(Exception $e){
            //dd($e);
            $this->notice::error('Please try again');
            return redirect()->back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $role=Role::get();
        $user=User::findOrFail(encryptor('decrypt',$id));
        return view('backend.user.edit',compact('user','role'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try{
            $data=User::findOrFail(encryptor('decrypt',$id));
            $data->name=$request->name;
            $data->email=$request->email;
            $data->contact_no=$request->contact_no;
            $data->status=$request->status;
            if($request->password)
                $data->password=Hash::make($request->password);

            if($request->hasFile('image')){
                $imageName = rand(111,999).time().'.'.$request->image->extension();
                $request->image->move(public_path('uploads/users'), $imageName);
                $data->image=$imageName;
            }
            if($data->save()){
                $this->notice::success('Successfully updated');
                return redirect()->route('user.index');
            }
        }catch(Exception $e){
            $this->notice::error('Please try again');
            //dd($e);
            return redirect()->back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data= User::findOrFail(encryptor('decrypt',$id));
        $image_path=public_path('uploads/users/').$data->image;
        
        if($data->delete()){
            if(File::exists($image_path)) 
                File::delete($image_path);
            $this->notice::warning('Deleted Permanently!');
            return redirect()->back();
        }
    }
}
