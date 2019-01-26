<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\Hash;

use App\Http\Requests\Admin\UserEditRequest;
use App\Http\Controllers\Controller;
use App\User;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $users = User::orderBy('created_at', 'DESC')->paginate(25);


        return view('admin/users/index')->with(['users' => $users,
                                                'message' => session('message')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
      return view('admin/users/edit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserEditRequest $request)
    {   
      
      
      $data = $request->validated();

      $data['password'] = Hash::make($data['password']);

      User::create($data);


      
      session()->flash('message', new MessageBag(['status' => 'success',
                                                  'message' => 'Good job! The user was created.']));

      return redirect()->route('admin.users.index');
        
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('admin/users/edit', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserEditRequest $request, $id)
    {
        
       $data = $request->validated();

       if(!$data['password']) {
           
         unset($data['password']);

       } else {

        $data['password'] = Hash::make($data['password']);

       }

       User::findOrFail($id)->update($data);

       session()->flash('message', new MessageBag(['status' => 'success',
                                                   'message' => 'Excellent! The user was edited.']));
       
       return redirect()->route('admin.users.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * 
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        
       $users = $request->only('destroy');
       

       if(empty($users['destroy'])) {
       
        session()->flash('message', new MessageBag(['status' => 'warning',
                                                    'message' => 'Oops! Nothing was deleted.']));
        return redirect()->back();
       }


        User::destroy($users['destroy']);


        session()->flash('message', new MessageBag(['status' => 'success',
                                                   'message' => 'Yeah! All selected users were deleted.']));
        
        return redirect()->route('admin.users.index');

    }
}
