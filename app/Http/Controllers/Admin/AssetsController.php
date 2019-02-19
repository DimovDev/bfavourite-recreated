<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Asset;

class AssetsController extends Controller
{

    public function autocomplete(Request $request) {

        $term = $request->only('term');
        $term = $term['term'] ?? null;
        $results = [];

        
      if ($term) {
        $assets = Asset::where('title', 'LIKE', '%'.$term.'%')->take(5)->get();
         
        foreach($assets as $asset) {

           $results[] = ['id' => $asset->id,
                         'value'=> $asset->title.' #'.$asset->asset_type];
        }

       } 
        return response()->json($results);

   }

}
