<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\Auth;

use App\Models\Asset\PhotoNote;
use App\Http\Requests\Admin\PhotoNoteEditRequest;
use App\Helpers\PillFieldHelper;

class PhotoNotesController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   

        return view('admin/assets/photoNotes/edit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PhotoNoteEditRequest $request)
    {
        $data = $request->validated();

        $photo = $request->only('photo');

        if(isset($photo['photo'])) {

            $photo = json_decode($photo['photo']);
            if(!empty($photo) && !empty($photo[0]->id)) $data['photo'] = (int) $photo[0]->id;
          }

        if(!empty($data['tags'])) $data['tags'] = PillFieldHelper::toArray($data['tags']);


        $photoNote = PhotoNote::create($data);
        
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
        $photoNote = PhotoNote::findOrFail($id);
        $photo = $photoNote->photo()->first();
        
        if($photo) $photoNote->photo = json_encode([$photo->toArray()]);

        $tags = $photoNote->tags()->get();
        $photoNote->tags = PillFieldHelper::dbRowsToJson($tags->toArray(), 'id', 'name');
    

        return view('admin/assets/photoNotes/edit', ['photo' => $photoNote]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PhotoNoteEditRequest $request, $id)
    {
        $data = $request->validated();
        
        $photoNote = PhotoNote::findOrFail($id);

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
