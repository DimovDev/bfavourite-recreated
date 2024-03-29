<?php

namespace App\Http\Middleware;

use Closure;
use App\Helpers\PageTitleHelper;
use Illuminate\Support\Facades\Auth;
use App\Helpers\Menu\SimpleMenuBuilder as MenuBuilder;

class AdminMenuMiddleware
{
  
  protected $menuBuilder;

  public function __construct(MenuBuilder $menuBuilder, PageTitleHelper $page_title) {

    $this->menuBuilder = $menuBuilder;

    $page_title->push('Admin');
    
     
  }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {    
        
        $this->menuBuilder->add('Admin Menu');
        
        $this->menuBuilder->find('Admin Menu')
                   ->add('Current User')
                   ->add('menu');

        $this->menuBuilder->find('Current User') 
                   ->add('Edit Your Profile', route('admin.users.edit', ['id' => Auth::id()]))
                   ->add('Go to Home', route('home'));      
        
        $this->menuBuilder->find('menu')
                   ->add('Newsfeed')
                   ->add('Posts')
                   ->add('Projects')
                   ->add('Tags')
                   ->add('Media')
                   ->add('Users');
                   
        $this->menuBuilder->find('Newsfeed')
                   ->setIcon('plus-square')
                   ->add('All Notes', route('admin.assets.index'))
                   ->add('Create', '#')
                   ->find('Create')
                   ->add('Text Note', route('admin.textNotes.create'))
                   ->add('Link Note', route('admin.linkNotes.create'))
                   ->add('Photo Note', route('admin.photoNotes.create'));
                   
        $this->menuBuilder->find('Posts')
                   ->setIcon('edit')
                   ->add('All Posts', route('admin.posts.index'))
                   ->add('Create Post', route('admin.posts.create'))
                   ->find('Projects')
                   ->setIcon('code')
                   ->add('All Projects', route('admin.projects.index'))
                   ->add('Create Project', route('admin.projects.create'))
                   ->find('Users')
                   ->setIcon('users')
                   ->add('All Users', route('admin.users.index'))
                   ->add('Create User', route('admin.users.create'))
                   ->find('Tags')
                   ->setIcon('tags')
                   ->add('All Tags', route('admin.tags.index'))
                   ->add('Create Tag', route('admin.tags.create'))
                   ->find('Media')
                   ->setIcon('images')
                   ->add('All Media', route('admin.media.index'))
                   ->add('Upload Media', route('admin.media.create'));           
        
        $this->menuBuilder->execute();

    

        $url = url()->current();         
        
        if($this->menuBuilder->findByUrl($url)->exists()) {
          
            $this->menuBuilder->findByUrl($url)->setActive(true, true)->execute();

        }

        return $next($request);
    }
}
