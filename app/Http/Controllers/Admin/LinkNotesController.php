<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\Auth;

use App\Models\Asset\LinkNote;
use App\Models\Media\{ImageFile, UrlImage, Media};
use App\Http\Requests\Admin\LinkNoteEditRequest;
use App\Http\Requests\Admin\OpenGraphRequest;
use App\Helpers\PillFieldHelper;
use App\Exceptions\UrlImageException;

use shweshi\OpenGraph\Facades\OpenGraphFacade as OpenGraph;

class LinkNotesController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   

        return view('admin/assets/linkNotes/edit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LinkNoteEditRequest $request)
    {
        $data = $request->validated();

        $photo = $request->only('photo');

        if(isset($photo['photo'])) {

            $photo = json_decode($photo['photo']);
            if(!empty($photo) && !empty($photo[0]->id)) $data['photo'] = (int) $photo[0]->id;
         }


        if(!empty($data['tags'])) $data['tags'] = PillFieldHelper::toArray($data['tags']);


        $link = LinkNote::create($data);
        
        $link->user()->attach(Auth::id());
        if(!empty($data['tags'])) $link->tags()->attach($data['tags']);



     
        
        session()->flash('message', new MessageBag(['status' => 'success',
                                                    'message' => 'Good job! The link was created.']));
  
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
        $link = LinkNote::findOrFail($id);
    

        $tags = $link->tags()->get();
        $link->tags = PillFieldHelper::dbRowsToJson($tags->toArray(), 'id', 'name');

        $photo = $link->photo()->first();
        if($photo) $link->photo = json_encode([$photo->toArray()]);

        return view('admin/assets/linkNotes/edit', ['link' => $link]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(LinkNoteEditRequest $request, $id)
    {
        $data = $request->validated();
        
        $link = LinkNote::findOrFail($id);

        $photo = $request->only('photo');
        $data['photo'] = null;

        if(isset($photo['photo'])) {

            $photo = json_decode($photo['photo']);
            if(!empty($photo) && !empty($photo[0]->id)) $data['photo'] = (int) $photo[0]->id;
         }
        
    
        if(!empty($data['tags'])) $data['tags'] = PillFieldHelper::toArray($data['tags']);


        $link->update($data);
        if(!empty($data['tags'])) $link->tags()->sync($data['tags']);
 
        session()->flash('message', new MessageBag(['status' => 'success',
                                                    'message' => 'Excellent! The link was edited.']));
        
        return redirect()->route('admin.assets.index');
    }

    public function opengraph(OpenGraphRequest $request) {

        $url = $request->input('link_url');

        $og = OpenGraph::fetch($url);
        $data = [];

        $host = parse_url(route('home'), PHP_URL_HOST);
        
        $is_own = stripos($url, $host) === 0 ? true : false;

        if(!empty($og)) {

            if(isset($og['url'])) $data['link_url'] = $og['url'];
            if(isset($og['title'])) $data['title'] = $og['title'];
            if(isset($og['description'])) $data['link_desc'] = $og['description'];
            if(isset($og['site_name'])) $data['publisher'] = $og['site_name'];
            if(isset($og['image'])) $data['photo'] = $og['image'];
            if(isset($og['image:url'])) $data['photo'] = $og['image:url'];


           try {
          //  $data['photo'] = 'http://bfavourite.local/admin/links/create';
           if(!$is_own) {

                $image = new UrlImage($data['photo'], config('media.images'));
        
                $image->upload();
        
                $sizes = $image->getAvailableSizes();
        
                $media = Media::create(['media_type' => $image->getClientMediaType(),
                                        'title' => $image->getClientFilename(),
                                        'url' => $image->getUri(),
                                        'sizes' => $sizes ? json_encode($sizes) : null]);

            } else {

               $media = Media::where('url', $url)->get();

            }

            $data['photo'] = $media->toArray();

        } catch (UrlImageException $e) { 

          $data['message'] = __('The url was fetched successfuly, but: ').$e->getMessage();

        } catch (\Exception $e) {
              
           $data['message'] = __('The url was fetched successfuly, but there is no valid OG image.');

       }

       if(empty($data)) abort(404, __('No Open Graph data is available!'));

        return response()->json($data);

    }
 } 

}
