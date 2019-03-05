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
use App\Helpers\Menu\SimpleMenuBuilder;
use App\Http\Controllers\Controller;

class NewsfeedController extends Controller
{
    protected $meta_tags;
    protected $page_title;
    protected $top_navigation;

    public function __construct(PageTitleHelper $page_title, SimpleMenuBuilder $top_navigation, MetaTagHelper $meta_tags) {
         
        $this->meta_tags = $meta_tags;
        $this->page_title = $page_title;
        $this->top_navigation = $top_navigation;

        $this->meta_tags->push('og:title', $this->page_title->get());
        $this->meta_tags->push('og:image', url('storage/fb-default.jpg'));
        $this->meta_tags->push('og:description', "BFavourite.com е онлайн визитката на Саше Вучков, с която да демонстрира своите знания и умнения в сферата на уеб програмирането.");
        $this->meta_tags->push('og:url', route('home'));

        $this->meta_tags->push('description', "BFavourite.com е онлайн визитката на Саше Вучков, с която да демонстрира своите знания и умнения в сферата на уеб програмирането.");
        


    }


    public function index() {
       
        $notes = Note::published()->paginate(5);

        $this->page_title->push(__('Home'));

        $this->meta_tags->push('og:title', $this->page_title->get());
 
        return view('frontend/newsfeed/index', ['notes' => $notes]);

    }

    public function tag(string $tag_ids, string $slug) {

        
       
        $tag_ids = explode(',', $tag_ids);

        $tags = Tag::active()->whereIn('id', $tag_ids)->get();
           
        if($tags->count() < 1) abort(404);
        
         
        $reduced = $tags->reduce(function($carry, $tag) {
          
             $carry .= ($carry ? ' & ' : null).'#'.$tag->name;
             return $carry;
        });

        $reduced_slugs = $tags->reduce(function($carry, $tag) {
          
            $carry .= ($carry ? '&' : null).$tag->slug;
            return $carry;

         });
     
        if($reduced_slugs != $slug) abort('404');

        $this->page_title->push($reduced);
        $this->page_title->push('Tags');

        $this->meta_tags->set('og:title', $this->page_title->get());
        $this->meta_tags->set('og:image', url('storage/fb-default.jpg'));
        $this->meta_tags->set('og:description', "Всички постове, проекти, бележки и друго съдържание с този таг.");
        $this->meta_tags->set('og:url', route('newsfeed.tag', ['id' => implode(',', $tag_ids),
                                                               'slug' => $reduced]));

        $this->meta_tags->set('description', "Всички постове, проекти, бележки и друго съдържание с този таг.");
         
       

        $notes = Tag::notesWithTags($tag_ids)->paginate(5);
    
    
        return view('frontend/newsfeed/tag', ['tags' => $tags,
                                              'notes' => $notes]); 

    } 



    public function post(int $post_id, string $slug) {
        
        $post = Post::with('user', 'tags')->findOrFail($post_id);

        if($post->slug != $slug) abort('404');

        $this->top_navigation->find('Blog')->setActive(true)->execute();

        $this->page_title->push($post->title);
        $this->page_title->push('#'.$post->tags()->first()->name);

        $this->meta_tags->set('og:title', $this->page_title->get());
        $this->meta_tags->set('og:image', $post->photo->full_path);
        $this->meta_tags->set('og:description', $post->summary);
        $this->meta_tags->set('og:url', route('newsfeed.post', ['id' => $post->id,
                                                                'slug' => $post->slug]));

        $this->meta_tags->set('description', $post->summary);


        return view('frontend/newsfeed/post', ['post' => $post]);
    }


    public function project(int $project_id, string $slug) {
        

        $project = Project::with('user', 'tags')->findOrFail($project_id);

        if($project->slug != $slug) abort('404');

        $this->top_navigation->find('Projects')->setActive(true)->execute();
        
        $this->page_title->push($project->title);
        $this->page_title->push('#'.$project->tags()->first()->name);

        $this->meta_tags->set('og:title', $this->page_title->get());
        $this->meta_tags->set('og:image', $project->photo->full_path);
        $this->meta_tags->set('og:description', $project->summary);
        $this->meta_tags->set('og:url', route('newsfeed.project', ['id' => $project->id,
                                                                   'slug' => $project->slug]));
        $this->meta_tags->set('description', $project->summary);
       

        return view('frontend/newsfeed/project', ['project' => $project]);
    }    

    public function projects_archive() {

        $projects = Project::published()->paginate();

        $this->page_title->push(__('Projects'));

        return view('frontend/newsfeed/archive', ['assets' => $projects]); 
    }

    public function posts_archive() {

        $posts = Post::published()->paginate();

        $this->page_title->push(__('Posts'));

        return view('frontend/newsfeed/archive', ['assets' => $posts]); 
    }

}
