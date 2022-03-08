<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Redirect,Response,DB,Config;
use Datatables;
use App\User;

class UserController extends Controller
{
    
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function indexTeachers(Request $request)
    {
    if ($request->ajax()) {
    $data = User::whereHas(
        'roles', function($q){
            $q->where('name', 'teacher');
        }
    )->get();
    return datatables()->of($data)
    ->addIndexColumn()
    ->addColumn('action', function($row){
    
    $action = '<a class="btn btn-info" id="show-user" data-toggle="modal" data-id='.$row->id.'>Show</a>
    <a class="btn btn-success" id="edit-user" data-toggle="modal" data-id='.$row->id.'>Edit </a>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <a id="delete-user" data-id='.$row->id.' class="btn btn-danger delete-user">Delete</a>';
    
    return $action;
    
    })
    ->rawColumns(['action'])
    ->make(true);
    }
    
    return view('teachers-list');
    }




    public function indexLearners(Request $request)
    {
    if ($request->ajax()) {
    $data =User::whereHas(
        'roles', function($q){
            $q->where('name', 'learner');
        }
    )->get();
    return datatables()->of($data)
    ->addIndexColumn()
    ->addColumn('action', function($row){
    
    $action = '<a class="btn btn-info" id="show-user" data-toggle="modal" data-id='.$row->id.'>Show</a>
    <a class="btn btn-success" id="edit-user" data-toggle="modal" data-id='.$row->id.'>Edit </a>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <a id="delete-user" data-id='.$row->id.' class="btn btn-danger delete-user">Delete</a>';
    
    return $action;
    
    })
    ->rawColumns(['action'])
    ->make(true);
    }
    
    return view('learners-list');
    }
    
    








    public function store(Request $request)
    {
    
    $r=$request->validate([
    'name' => 'required',
    'email' => 'required',
    'first_name' => 'required',
    'last_name' => 'required',
     'password' => 'required',
    
    ]);
    
    $userId = $request->user_id;
    $user = User::updateOrCreate(['id' => $userId],['name' => $request->name,
                                             'email' => $request->email,
                                             'first_name' => $request->first_name,
                                             'last_name' => $request->last_name,
                                             'password' => Hash::make($request['password'])]);
                                            
    if ($request->is('teachers-list')){
     $user->roles()->attach('1');  
    }
    elseif($request->is('learners-list')){
        $user->roles()->attach('2');   
    }                             
                                    
    if(empty($request->user_id)){
    $msg = 'User created successfully.';
    }
    else{
    $msg = 'User data is updated successfully';
    }
    if ($request->is('teachers-list')){
    return redirect()->route('teachers.index')->with('success',$msg);
    }
    elseif($request->is('learners-list')){
    return redirect()->route('learners.index')->with('success',$msg);
    }

    }
    
    /**
    * Display the specified resource.
    *
    * @param int $id
    * @return \Illuminate\Http\Response
    */
    
    public function show($id)
    {
    $where = array('id' => $id);
    $user = User::where($where)->first();
    return Response::json($user);
    //return view('users.show',compact('user'));
    }
    
    /**
    * Show the form for editing the specified resource.
    *
    * @param int $id
    * @return \Illuminate\Http\Response
    */
    
    public function edit($id)
    {
    $where = array('id' => $id);
    $user = User::where($where)->first();
    return Response::json($user);
    }
    
    /**
    * Remove the specified resource from storage.
    *
    * @param int $id
    * @return \Illuminate\Http\Response
    */
    
    public function destroy($id)
    {
    $user = User::where('id',$id)->delete();
    return Response::json($user);
    //return redirect()->route('users.index');
    }
    

    public function ShowTeachers(){
     
        $teachers = User::whereHas(
            'roles', function($q){
                $q->where('name', 'teacher');
            }
        )->get();
        return view ('show-teachers')->with('teachers',$teachers);

    }

    public function update(Request $request){
            
        $user = Auth::user();
        $this->validate($request,[
            'first_name' => 'required',
            'last_name' => 'required',
            'name' => 'required',
            'email' => 'required',

        ]);
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->name = $request->name;
        $user->email = $request->email;

        if($request->password){

            $this->validate($request,[
                'password' => 'min:6|confirmed',
            ]);

            $user->password = bcrypt($request->password);
        }

        if($request->hasFile('profile_image')){

            $this->validate($request,[

                'profile_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            $profileName = $user->id.'_avatar'.time().'.'.request()->profile_image->getClientOriginalName();
            $request->profile_image->storeAs('avatars',$profileName);
            $user->profile_image = $profileName;
        }

        $user->save();

        return redirect()->back();

    }


}
