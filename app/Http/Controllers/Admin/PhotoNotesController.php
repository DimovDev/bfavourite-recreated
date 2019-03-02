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
        $data['user_id'] = Auth::id();
 

        $photoNote = PhotoNote::create($data);
        
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

        $photoNote->update($data);
  
        session()->flash('message', new MessageBag(['status' => 'success',
                                                    'message' => 'Excellent! The photo was edited.']));
        
        return redirect()->route('admin.assets.index');
    }


}
