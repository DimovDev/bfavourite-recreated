<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;

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
        $data = $request->all();

   
        Project::create($data);
  
        
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
        $data = $request->all();
        
        Project::findOrFail($id)->update($data);
 
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
            $project->assetsMeta()->delete();
            $project->delete();
          }
        }
 
         session()->flash('message', new MessageBag(['status' => 'success',
                                                     'message' => 'Yeah! All selected projects were deleted.']));
         
         return redirect()->route('admin.projects.index');
    }
}
