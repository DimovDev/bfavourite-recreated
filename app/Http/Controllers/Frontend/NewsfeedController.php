<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Asset\Note;
use App\Models\Asset\Post;
use App\Models\Asset\Asset;
use App\Models\Taxonomy\Tag;
use Illuminate\Http\Request;
use App\Models\Asset\Project;
use App\Helpers\MetaTagHelper;
use App\Helpers\PageTitleHelper;
use App\Http\Controllers\Controller;

class NewsfeedController extends Controller
{
    protected $meta_tags;
    protected $page_title;

    public function __construct(MetaTagHelper $meta_tags, PageTitleHelper $page_title) {
         
        $this->meta_tags = $meta_tags;
        $this->page_title = $page_title;


    }


    public function index() {
       
        $notes = Note::published()->paginate();
 
        return view('frontend/newsfeed/index', ['notes' => $notes]);

    }

    public function tag(string $tag_ids) {
       
        $tag_ids = explode(',', $tag_ids);

        $tags = Tag::where('taxonomy_status', 'active')->whereIn('id', $tag_ids)->get();
           
        if($tags->count() < 1) abort(404);

     

        $notes = Tag::notesWithTags($tag_ids)->paginate();
    
    
        return view('frontend/newsfeed/tag', ['tags' => $tags,
                                              'notes' => $notes]); 

    } 



    public function post(int $post_id) {
        
        $post = Post::findOrFail($post_id);

        $this->page_title->push($post->title);
        $this->page_title->push('#'.$post->tags()->first()->name);

        $this->meta_tags->push('og:title', $this->page_title->get());
        $this->meta_tags->push('og:image', $post->photo->full_path);
        $this->meta_tags->push('og:description', $post->summary);
        $this->meta_tags->push('og:url', route('newsfeed.post', ['id' => $post->id]));

        return view('frontend/newsfeed/post', ['post' => $post]);
    }


    public function project(int $project_id) {
        
        $project = Project::findOrFail($project_id);
        
        $this->page_title->push($project->title);
        $this->page_title->push('#'.$project->tags()->first()->name);

        $this->meta_tags->push('og:title', $this->page_title->get());
        $this->meta_tags->push('og:image', $project->photo->full_path);
        $this->meta_tags->push('og:description', $project->summary);
        $this->meta_tags->push('og:url', route('newsfeed.project', ['id' => $project->id]));

       

        return view('frontend/newsfeed/project', ['project' => $project]);
    }    

    public function projects_archive() {

        $projects = Project::published()->paginate();

        return view('frontend/newsfeed/archive', ['assets' => $projects]); 
    }

    public function posts_archive() {

        $posts = Post::published()->paginate();

        return view('frontend/newsfeed/archive', ['assets' => $posts]); 
    }

}
