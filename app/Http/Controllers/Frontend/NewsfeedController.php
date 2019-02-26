<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Asset\Post;
use App\Models\Asset\Asset;
use App\Models\Taxonomy\Tag;
use Illuminate\Http\Request;
use App\Models\Asset\Project;
use App\Http\Controllers\Controller;

class NewsfeedController extends Controller
{
    
    public function index() {
       
        $notes = Asset::notes();
        
        return view('frontend/newsfeed/index', ['notes' => $notes]);

    }

    public function tag(string $tag_ids) {
       
        $tag_ids = explode(',', $tag_ids);
         
        $tags = Tag::where('taxonomy_status', 'active')->whereIn('id', $tag_ids)->get();
           
        if($tags->count() < 1) abort(404);

        $notes = Tag::notes($tag_ids);
    
        return view('frontend/newsfeed/tag', ['tags' => $tags,
                                              'notes' => $notes]); 

    } 


    public function post(int $post_id) {
        
        $post = Post::findOrFail($post_id);

        return view('frontend/newsfeed/post', ['post' => $post]);
    }


    public function project(int $project_id) {
        
        $project = Project::findOrFail($project_id);

        return view('frontend/newsfeed/project', ['project' => $project]);
    }    
}
