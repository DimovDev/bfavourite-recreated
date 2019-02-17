<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\MessageBag;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TagEditRequest;

use App\Tag;


class TagsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = Tag::orderBy('created_at', 'DESC')->paginate(25);


        return view('admin/taxonomies/tags/index')->with(['tags' => $tags,
                                                          'message' => session('message')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/taxonomies/tags/edit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TagEditRequest $request)
    {
        $data = $request->validated();

        $icon = $request->only('icon');
        $data['icon'] = null;

        if(isset($icon['icon'])) {

            $icon = json_decode($icon['icon']);
            if(!empty($icon) && !empty($icon[0]->id)) $data['icon'] = (int) $icon[0]->id;
        }

        $tag = Tag::create($data);
        $tag->user()->attach(Auth::id());
        
        session()->flash('message', new MessageBag(['status' => 'success',
                                                    'message' => 'Good job! The tag was created.']));
  
        return redirect()->route('admin.tags.index');
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tag = Tag::findOrFail($id);

        $icon = $tag->icon()->first();
        
        if($icon) $tag->icon = json_encode([$icon->toArray()]);

        return view('admin/taxonomies/tags/edit', ['tag' => $tag]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TagEditRequest $request, $id)
    {
         
        $data = $request->validated();
        
        $tag = Tag::findOrFail($id);

        $icon = $request->only('icon');
        $data['icon'] = null;

        if(isset($icon['icon'])) {

            $icon = json_decode($icon['icon']);
            if(!empty($icon) && !empty($icon[0]->id)) $data['icon'] = (int) $icon[0]->id;
         }

        $tag->update($data);
 
        session()->flash('message', new MessageBag(['status' => 'success',
                                                    'message' => 'Excellent! The tag was edited.']));
        
        return redirect()->route('admin.tags.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $input = $request->only('destroy');
       

        if(empty($input['destroy'])) {
        
         session()->flash('message', new MessageBag(['status' => 'warning',
                                                     'message' => 'Oops! Nothing was deleted.']));
         return redirect()->back();
        }
 
        
        foreach($input['destroy'] AS $tag_id) {

   
            $tag = Tag::find($tag_id);
  
  
            if($tag) {
              $tag->user()->detach();
              $tag->posts()->detach();
              $tag->projects()->detach();
              $tag->delete();
            }

          }
          
     
 
    
 
         session()->flash('message', new MessageBag(['status' => 'success',
                                                     'message' => 'Yeah! All selected tags were deleted.']));
         
         return redirect()->route('admin.tags.index');
    }

    public function autocomplete(Request $request) {

         $term = $request->only('term');
         $term = $term['term'] ?? null;
         $results = [];
         
       if ($term) {
         $tags = Tag::where('name', 'LIKE', '%'.$term.'%')->take(5)->get();
          
         foreach($tags as $tag) {

            $results[] = ['id' => $tag->id,
                          'value'=> $tag->name];
         }
        } 
         return response()->json($results);

    }
}
