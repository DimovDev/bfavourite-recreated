<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\Auth;


use App\Http\Requests\Admin\PostEditRequest;
use App\Http\Controllers\Controller;
use App\Models\Asset\Post;

use App\Helpers\PillFieldHelper;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::with('tags', 'user', 'photo')->orderBy('created_at', 'DESC')->paginate(25);
        
                  
        $this->page_title->unshift('All Posts');
        $this->menu->find('All Posts')->setActive(true, true);
      
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
        $this->page_title->unshift('Create Post');
        $this->menu->find('Create Post')->setActive(true, true);

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
        $data['user_id'] = Auth::id();

        $post = Post::create($data);
        

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

        $this->page_title->unshift('Edit Post');
        $this->menu->find('Create Post')->setActive(true, true);

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
        
        $post = Post::findOrFail($id);

        $post->update($data);


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
 
        
        foreach($posts['destroy'] as $id) {
           
          $post = Post::find($id);
          
          if($post) $post->delete();
          
        }
         
 
         session()->flash('message', new MessageBag(['status' => 'success',
                                                     'message' => 'Yeah! All selected posts were deleted.']));
         
         return redirect()->route('admin.posts.index');
    }
}
