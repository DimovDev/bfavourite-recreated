<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Helpers\MetaTagHelper;
use App\Helpers\PageTitleHelper;
use App\Helpers\Menu\SimpleMenuBuilder;

class PagesController extends Controller
{  
    protected $meta_tags;
    protected $page_title;
    protected $top_navigation;

    public function __construct(PageTitleHelper $page_title, SimpleMenuBuilder $top_navigation, MetaTagHelper $meta_tags) {
         
        $this->meta_tags = $meta_tags;
        $this->page_title = $page_title;
        $this->top_navigation = $top_navigation;


    }

    public function about() {

        $this->page_title->push(__('About Sashe'));

        $this->meta_tags->push('og:title', $this->page_title->get());
        $this->meta_tags->push('og:image', url('storage/fb-default.jpg'));
        $this->meta_tags->push('og:description', "BFavourite.com е онлайн визитката на Саше Вучков, с която да демонстрира своите знания и умнения в сферата на уеб програмирането.");
        $this->meta_tags->push('og:url', route('home'));

        $this->meta_tags->push('description', "BFavourite.com е онлайн визитката на Саше Вучков, с която да демонстрира своите знания и умнения в сферата на уеб програмирането.");
        

       
        return view('frontend.pages.about');

    }

    public function contacts() {

        $this->page_title->push(__('Contacts'));

        $this->meta_tags->push('og:title', $this->page_title->get());
        $this->meta_tags->push('og:image', url('storage/fb-default.jpg'));
        $this->meta_tags->push('og:description', "BFavourite.com е онлайн визитката на Саше Вучков, с която да демонстрира своите знания и умнения в сферата на уеб програмирането.");
        $this->meta_tags->push('og:url', route('home'));

        $this->meta_tags->push('description', "BFavourite.com е онлайн визитката на Саше Вучков, с която да демонстрира своите знания и умнения в сферата на уеб програмирането.");
        

       
        return view('frontend.pages.contacts');

    }
}
