<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\Auth;

use App\Models\Asset\TextNote;
use App\Http\Requests\Admin\TextNoteEditRequest;
use App\Helpers\PillFieldHelper;

class TextNotesController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $this->page_title->unshift('Create Text Note');
        $this->menu->find('Text Note')->setActive(true, true);

        return view('admin/assets/textNotes/edit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TextNoteEditRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = Auth::id();
 
    
        $note = TextNote::create($data);

        
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
        $note = TextNote::with('tags', 'user')->findOrFail($id);

        $this->page_title->unshift('Edit Text Note');
        $this->menu->find('Text Note')->setActive(true, true);
    
        return view('admin/assets/textNotes/edit', ['note' => $note]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TextNoteEditRequest $request, $id)
    {
        $data = $request->validated();
        
        $note = TextNote::findOrFail($id);

        $note->update($data);
   
 
        session()->flash('message', new MessageBag(['status' => 'success',
                                                    'message' => 'Excellent! The note was edited.']));
        
        return redirect()->route('admin.assets.index');
    }

}