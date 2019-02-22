<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\Auth;

use App\Models\Asset\Photo;
use App\Http\Requests\Admin\PhotoEditRequest;
use App\Helpers\PillFieldHelper;

class PhotosController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   

        return view('admin/assets/photos/edit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PhotoEditRequest $request)
    {
        $data = $request->validated();

        $photo = $request->only('photo');

        if(isset($photo['photo'])) {

            $photo = json_decode($photo['photo']);
            if(!empty($photo) && !empty($photo[0]->id)) $data['photo'] = (int) $photo[0]->id;
          }

        if(!empty($data['tags'])) $data['tags'] = PillFieldHelper::toArray($data['tags']);


        $photoNote = Photo::create($data);
        
        $photoNote->user()->attach(Auth::id());
        if(!empty($data['tags'])) $photoNote->tags()->attach($data['tags']);



     
        
        session()->flash('message', new MessageBag(['status' => 'success',
                                                    'message' => 'Good job! The photo was created.']));
  
        return redirect()->route('admin.assets.index');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $photoNote = Photo::findOrFail($id);
        $photo = $photoNote->photo()->first();
        
        if($photo) $photoNote->photo = json_encode([$photo->toArray()]);

        $tags = $photoNote->tags()->get();
        $photoNote->tags = PillFieldHelper::dbRowsToJson($tags->toArray(), 'id', 'name');
    

        return view('admin/assets/photos/edit', ['photo' => $photoNote]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PhotoEditRequest $request, $id)
    {
        $data = $request->validated();
        
        $photoNote = Photo::findOrFail($id);

        $photo = $request->only('photo');
        $data['photo'] = null;

        if(isset($photo['photo'])) {

            $photo = json_decode($photo['photo']);
            if(!empty($photo) && !empty($photo[0]->id)) $data['photo'] = (int) $photo[0]->id;
         }
        
    
        if(!empty($data['tags'])) $data['tags'] = PillFieldHelper::toArray($data['tags']);


        $photoNote->update($data);
        $photoNote->tags()->sync($data['tags']);
 
        session()->flash('message', new MessageBag(['status' => 'success',
                                                    'message' => 'Excellent! The photo was edited.']));
        
        return redirect()->route('admin.assets.index');
    }


}
