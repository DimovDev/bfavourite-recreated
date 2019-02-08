<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;

use App\Project;
Use App\Http\Requests\Admin\ProjectEditRequest;


class ProjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::orderBy('created_at', 'DESC')->paginate(25);


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
        
        $photo = $request->only('photo');

        if(isset($photo['photo'])) {

            $photo = json_decode($photo['photo']);
            if(!empty($photo) && !empty($photo[0]->id)) $data['photo'] = (int) $photo[0]->id;
         }


   
        $project = Project::create($data);
        $project->user()->attach(Auth::id());
        $project->category()->attach($data['category']);
        
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
        if($photo) $project->photo = json_encode([$photo->toArray()]);

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

        $photo = $request->only('photo');
        $data['photo'] = null;

        if(isset($photo['photo'])) {

            $photo = json_decode($photo['photo']);
            if(!empty($photo) && !empty($photo[0]->id)) $data['photo'] = (int) $photo[0]->id;
         }


        $project->update($data);
        $project->category()->sync($data['category']);
 
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
            $project->category()->detach();

            $project->assetsMeta()->delete();
            $project->delete();
          }
        }
 
         session()->flash('message', new MessageBag(['status' => 'success',
                                                     'message' => 'Yeah! All selected projects were deleted.']));
         
         return redirect()->route('admin.projects.index');
    }
}
