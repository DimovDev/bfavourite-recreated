<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryEditRequest;
use Illuminate\Support\MessageBag;
use App\Category;


class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cateogries = Category::orderBy('created_at', 'DESC')->paginate(25);


        return view('admin/taxonomies/categories/index')->with(['categories' => $cateogries,
                                                                 'message' => session('message')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/taxonomies/categories/edit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryEditRequest $request)
    {
        $data = $request->validated();

        Category::create($data);
  
        
        session()->flash('message', new MessageBag(['status' => 'success',
                                                    'message' => 'Good job! The category was created.']));
  
        return redirect()->route('admin.categories.index');
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);

        return view('admin/taxonomies/categories/edit', ['category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryEditRequest $request, $id)
    {
         
        $data = $request->validated();
        
        Category::findOrFail($id)->update($data);
 
        session()->flash('message', new MessageBag(['status' => 'success',
                                                    'message' => 'Excellent! The category was edited.']));
        
        return redirect()->route('admin.categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $categories = $request->only('destroy');
       

        if(empty($categories['destroy'])) {
        
         session()->flash('message', new MessageBag(['status' => 'warning',
                                                     'message' => 'Oops! Nothing was deleted.']));
         return redirect()->back();
        }
 
    
        Category::destroy($categories['destroy']);
 
    
 
         session()->flash('message', new MessageBag(['status' => 'success',
                                                     'message' => 'Yeah! All selected categories were deleted.']));
         
         return redirect()->route('admin.categories.index');
    }
}
