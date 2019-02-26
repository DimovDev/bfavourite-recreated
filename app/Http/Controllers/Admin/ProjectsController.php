<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;

use App\Models\Asset\Project;
use App\Http\Requests\Admin\ProjectEditRequest;

use App\Helpers\PillFieldHelper;


class ProjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::with('tags')->orderBy('created_at', 'DESC')->paginate(25);


        return view('admin/assets/projects/index')->with(['projects' => $projects,
                                                       'message' => session('message')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/assets/projects/edit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProjectEditRequest $request)
    {
        $data = $request->validated();
        
        $photo = $request->only('photo_id');

        if(isset($photo['photo_id'])) {

            $photo = json_decode($photo['photo_id']);
            if(!empty($photo) && !empty($photo[0]->id)) $data['photo_id'] = (int) $photo[0]->id;
         }

        if(!empty($data['tags'])) $data['tags'] = PillFieldHelper::toArray($data['tags']);
   
        $project = Project::create($data);
        $project->user()->attach(Auth::id());
        $project->tags()->attach($data['tags']);
        
        session()->flash('message', new MessageBag(['status' => 'success',
                                                    'message' => 'Good job! The project was created.']));
  
        return redirect()->route('admin.projects.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $project = Project::findOrFail($id);
        
        $photo = $project->photo()->first();
        $tags = $project->tags()->get();

        if($photo) $project->photo = json_encode([$photo->toArray()]);
        $project->tags = PillFieldHelper::dbRowsToJson($tags->toArray(), 'id', 'name');
    

        return view('admin/assets/projects/edit', ['project' => $project]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProjectEditRequest $request, $id)
    {
        $data = $request->validated();
        
        $project = Project::findOrFail($id);

        $photo = $request->only('photo_id');
        $data['photo_id'] = null;

        if(isset($photo['photo_id'])) {

            $photo = json_decode($photo['photo_id']);
            if(!empty($photo) && !empty($photo[0]->id)) $data['photo_id'] = (int) $photo[0]->id;
         }

         if(!empty($data['tags'])) $data['tags'] = PillFieldHelper::toArray($data['tags']);



        $project->update($data);
        $project->tags()->sync($data['tags']);
 
        session()->flash('message', new MessageBag(['status' => 'success',
                                                    'message' => 'Excellent! The project was edited.']));
        
        return redirect()->route('admin.projects.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $projects = $request->only('destroy');
  
        if(empty($projects['destroy'])) {
        
         session()->flash('message', new MessageBag(['status' => 'warning',
                                                     'message' => 'Oops! Nothing was deleted.']));
         return redirect()->back();
        }
 
        foreach($projects['destroy'] AS $project_id) {

   
          $project = Project::find($project_id);


          if($project) {
            $project->user()->detach();
            $project->tags()->detach();

            $project->assetsMeta()->delete();
            $project->delete();
          }
        }
 
         session()->flash('message', new MessageBag(['status' => 'success',
                                                     'message' => 'Yeah! All selected projects were deleted.']));
         
         return redirect()->route('admin.projects.index');
    }
}
