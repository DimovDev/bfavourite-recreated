<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use App\Helpers\PageTitleHelper;
use App\Helpers\Menu\SimpleMenuBuilder;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $page_title;
    protected $menu;

    public function __construct(PageTitleHelper $page_title, SimpleMenuBuilder $menu) {
     
        $this->page_title = $page_title;
        $this->menu = $menu;
      
    }
}
