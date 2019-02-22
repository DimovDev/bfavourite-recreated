<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\Auth;

use App\Models\Asset\Note;
use App\Http\Requests\Admin\NoteEditRequest;
use App\Helpers\PillFieldHelper;

class NotesController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   

        return view('admin/assets/notes/edit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NoteEditRequest $request)
    {
        $data = $request->validated();


        if(!empty($data['tags'])) $data['tags'] = PillFieldHelper::toArray($data['tags']);


        $note = Note::create($data);
        
        $note->user()->attach(Auth::id());
        if(!empty($data['tags'])) $note->tags()->attach($data['tags']);



     
        
        session()->flash('message', new MessageBag(['status' => 'success',
                                                    'message' => 'Good job! The note was created.']));
  
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
        $note = Note::findOrFail($id);
    

        $tags = $note->tags()->get();
        $note->tags = PillFieldHelper::dbRowsToJson($tags->toArray(), 'id', 'name');
    

        return view('admin/assets/notes/edit', ['note' => $note]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(NoteEditRequest $request, $id)
    {
        $data = $request->validated();
        
        $note = Note::findOrFail($id);

        
    
        if(!empty($data['tags'])) $data['tags'] = PillFieldHelper::toArray($data['tags']);


        $note->update($data);
        if(!empty($data['tags'])) $note->tags()->sync($data['tags']);
 
        session()->flash('message', new MessageBag(['status' => 'success',
                                                    'message' => 'Excellent! The note was edited.']));
        
        return redirect()->route('admin.assets.index');
    }

}