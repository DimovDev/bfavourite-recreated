<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MediaUploadRequest;

use App\{Media, ImageFile};

class MediaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
    
      $media = Media::orderBy('created_at', 'DESC')->paginate(15);
        
      foreach($media AS $m) {
        
        if(strpos($m->media_type, 'image') !== false) {
           
            $m->icon = ImageFile::imgExists($m->url, storage_path(config('media.images.upload_path')), 'small');
        }

      }  
       
   
       if($request->ajax()) return response()->json(['message' => session('message'), 'paginator' => $media]);
   
  
       return view('admin/media/index')->with(['media' => $media,
                                               'message' => session('message')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    { 
       
       return view('admin/media/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MediaUploadRequest $request)
    {
      // var_dump($request->file('file'));
      $image = new ImageFile($request->file('file'), config('media.images'));

      $image->upload();

      $sizes = $image->getAvailableSizes();

      Media::create(['media_type' => $image->getClientMediaType(),
      'title' => $image->getClientFilename(),
      'url' => $image->getUri(),
      'sizes' => $sizes ? json_encode($sizes) : null]);

      session()->flash('message', new MessageBag(['status' => 'success',
                                                  'message' => 'Nice! The file was uploaded.']));

      return redirect()->route('admin.media.index');

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */

    public function destroy(Request $request)
    {
        $files = $request->only('destroy');
       

        if(empty($files['destroy'])) {
        
         session()->flash('message', new MessageBag(['status' => 'warning',
                                                     'message' => 'Oops! Nothing was deleted.']));
         return redirect()->back();
        }
 
        
        foreach($files['destroy'] as $id) {
           
          $file = Media::find($id);
          
          if($file) { 
            $path = storage_path(config('media.images.upload_path')).$file->url;
            ImageFile::delete($path);
            $file->delete();
          }

        }
 
 
         session()->flash('message', new MessageBag(['status' => 'success',
                                                     'message' => 'Yeah! All selected files were deleted.']));
         
         return redirect()->route('admin.media.index');
    }
}
