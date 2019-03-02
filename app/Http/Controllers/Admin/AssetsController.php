<?php

namespace App\Http\Controllers\Admin;

use App\Models\Asset\Note;
use App\Models\Asset\Asset;
use Illuminate\Http\Request;
use App\Models\User\UserPivot;

use Illuminate\Support\Facade\DB;

use Illuminate\Support\MessageBag;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Taxonomy\TaxonomyPivot;

class AssetsController extends Controller
{
     
    public function index() {

      $assets = Note::whereNotIn('asset_type', ['post', 'project'])->orderBy('created_at', 'DESC')->paginate(25);
        

      
      return view('admin/assets/index')->with(['assets' => $assets,
                                               'message' => session('message')]);

    }


   /**
     * Remove the specified resource from storage.
     *
     * @param  Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $assets = $request->only('destroy');
  
        if(empty($assets['destroy'])) {
        
         session()->flash('message', new MessageBag(['status' => 'warning',
                                                     'message' => 'Oops! Nothing was deleted.']));
         return redirect()->back();
        }
 
        foreach($assets['destroy'] AS $asset_id) {

   
          $asset = Note::find($asset_id);


          if($asset) $asset->delete();
          

        }
 
         session()->flash('message', new MessageBag(['status' => 'success',
                                                     'message' => 'Yeah! All selected assets were deleted.']));
         
         return redirect()->route('admin.assets.index');
    }


    public function autocomplete(Request $request) {

        $term = $request->only('term');
        $types = $request->only('types');
        if($types) $types = explode(',', $types['types']);

        $term = $term['term'] ?? null;
        $results = [];

        
      if ($term) {

        $assets = Asset::where('title', 'LIKE', '%'.$term.'%');

        if(!empty($types)) $assets->whereIn('asset_type', $types);
        
        $assets = $assets->take(5)->get();

        foreach($assets as $asset) {

           $results[] = ['id' => $asset->id,
                         'value'=> $asset->title.' #'.$asset->asset_type,
                         'url' => route('newsfeed.'.$asset->asset_type, ['id'=>$asset->id])];
        }

       } 
        return response()->json($results);

   }

}
