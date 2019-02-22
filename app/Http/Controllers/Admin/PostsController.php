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
        $posts = Post::with('tags')->orderBy('created_at', 'DESC')->paginate(25);

      
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

        $photo = $request->only('photo');

        if(isset($photo['photo'])) {

            $photo = json_decode($photo['photo']);
            if(!empty($photo) && !empty($photo[0]->id)) $data['photo'] = (int) $photo[0]->id;
          }

        if(!empty($data['tags'])) $data['tags'] = PillFieldHelper::toArray($data['tags']);


        $post = Post::create($data);
        
        $post->user()->attach(Auth::id());
        $post->tags()->attach($data['tags']);



     
        
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
        $photo = $post->photo()->first();
        
        if($photo) $post->photo = json_encode([$photo->toArray()]);

        $tags = $post->tags()->get();
        $post->tags = PillFieldHelper::dbRowsToJson($tags->toArray(), 'id', 'name');
    

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

        $photo = $request->only('photo');
        $data['photo'] = null;

        if(isset($photo['photo'])) {

            $photo = json_decode($photo['photo']);
            if(!empty($photo) && !empty($photo[0]->id)) $data['photo'] = (int) $photo[0]->id;
         }
        
    
        if(!empty($data['tags'])) $data['tags'] = PillFieldHelper::toArray($data['tags']);


        $post->update($data);
        $post->tags()->sync($data['tags']);
 
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
          
          if($post) { 
            $post->user()->detach();
            $post->tags()->detach();
            $post->delete();
          }

        }
         
        
 
      
 
         session()->flash('message', new MessageBag(['status' => 'success',
                                                     'message' => 'Yeah! All selected posts were deleted.']));
         
         return redirect()->route('admin.posts.index');
    }
}
