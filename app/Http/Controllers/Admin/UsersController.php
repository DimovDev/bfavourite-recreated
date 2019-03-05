<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\Hash;

use App\Http\Requests\Admin\UserEditRequest;
use App\Http\Controllers\Controller;
use App\Models\User\User;

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

        $this->page_title->unshift('All Users');
        $this->menu->find('All Users')->setActive(true, true);


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
      $this->page_title->unshift('Create User');
      $this->menu->find('Create User')->setActive(true, true);

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

      $photo = $request->only('photo_id');
      $data['photo_id'] = null;

      if(isset($photo['photo_id'])) {

          $photo = json_decode($photo['photo_id']);
          if(!empty($photo) && !empty($photo[0]->id)) $data['photo_id'] = (int) $photo[0]->id;
       }


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

        $this->page_title->unshift('Edit User');
        $this->menu->find('Create User')->setActive(true, true);

        $photo = $user->photo()->first();
        
        if($photo) $user->photo = json_encode([$photo->toArray()]);

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

       $photo = $request->only('photo_id');
       $data['photo_id'] = null;

       if(isset($photo['photo_id'])) {

           $photo = json_decode($photo['photo_id']);
           if(!empty($photo) && !empty($photo[0]->id)) $data['photo_id'] = (int) $photo[0]->id;
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


        foreach ($users['destroy'] as $user_id) {
          
           $user = User::find($user_id);
           
           if($user) {
            
             $user->posts()->detach();
             $user->tags()->detach();
             $user->projects()->detach();
             $user->delete();
           }

        }


        session()->flash('message', new MessageBag(['status' => 'success',
                                                   'message' => 'Yeah! All selected users were deleted.']));
        
        return redirect()->route('admin.users.index');

    }
}
