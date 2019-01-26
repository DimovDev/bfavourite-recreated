<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;

use App\Http\Requests\Admin\PostEditRequest;
use App\Http\Controllers\Controller;
use App\Post;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('created_at', 'DESC')->paginate(25);


        return view('admin/assets/posts/index')->with(['posts' => $posts,
                                                       'message' => session('message')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/assets/posts/edit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostEditRequest $request)
    {
        $data = $request->validated();

   
        Post::create($data);
  
        
        session()->flash('message', new MessageBag(['status' => 'success',
                                                    'message' => 'Good job! The post was created.']));
  
        return redirect()->route('admin.posts.index');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);

        return view('admin/assets/posts/edit', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostEditRequest $request, $id)
    {
        $data = $request->validated();
        
        Post::findOrFail($id)->update($data);
 
        session()->flash('message', new MessageBag(['status' => 'success',
                                                    'message' => 'Excellent! The post was edited.']));
        
        return redirect()->route('admin.posts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $posts = $request->only('destroy');
       

        if(empty($posts['destroy'])) {
        
         session()->flash('message', new MessageBag(['status' => 'warning',
                                                     'message' => 'Oops! Nothing was deleted.']));
         return redirect()->back();
        }
 
       
         
        Post::destroy($posts['destroy']);
 
      
 
         session()->flash('message', new MessageBag(['status' => 'success',
                                                     'message' => 'Yeah! All selected posts were deleted.']));
         
         return redirect()->route('admin.posts.index');
    }
}
