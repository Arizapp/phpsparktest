<?php

namespace App\Libraries;

use App\Entities\Category;
use App\Entities\Imovel;
use App\Entities\Lawyer;
use App\Entities\SysCity;
use App\Entities\SysPage;
use App\Entities\SysPageUri;
use App\Models\Categories;
use App\Models\Imoveis;
use App\Models\Lawyers;
use App\Models\SysBlog;
use App\Models\SysCities;
use App\Models\SysPages;

class RouteManager
{

    const PATH = APPPATH . 'Routes' . DIRECTORY_SEPARATOR;

    public function __construct()
    {
        helper('text');
    }



    /* Categories *///region
    public function categoriesSync()
    {
        $categories = [];

        /** @var Category $category */
        foreach ((new Categories())->findAll() as $category) {
            $key = $category->id;
            $value = url_title($category->name, '-', true);
            $categories[$key] = convert_accented_characters($value);
        }

        file_put_contents(self::PATH . 'Categories.php', "<?php return " . var_export($categories, true) . ';' . PHP_EOL);

        return $this;
    }
    //region

    /* Cities *///region
    public function citiesSync()
    {
        $cities = [];

        /** @var SysCity $city */
        foreach ((new SysCities())->findEnabled() as $city) {
            $key = $city->id;
            $value = url_title(implode(' ', [$city->name, $city->state->code]), '-', true);
            $cities[$key] = convert_accented_characters($value);
        }

        file_put_contents(self::PATH . 'Cities.php', "<?php return " . var_export($cities, true) . ';' . PHP_EOL);

        return $this;
    }
    //endregion

    /* Lawyer *///region
    public function lawyersSync()
    {
        $lawyers = [];

        /** @var Lawyer $lawyer */
        foreach ((new Lawyers())->findActive() as $lawyer) {
            $key = $lawyer->id;
            $value = url_title(implode(' ', [$lawyer->name, $lawyer->surname, $lawyer->oab]), '-', true);
            $lawyers[$key] = convert_accented_characters($value);
        }

        file_put_contents(self::PATH . 'Lawyers.php', "<?php return " . var_export($lawyers, true) . ';' . PHP_EOL);

        return $this;
    }

    //endregion

    public function blogSync()
    {
        /** @var \App\Entities\SysBlog $blog */
        $blog = (new SysBlog())->first();
        $uris = [
            "{$blog->uri}"        => 'Blog::index',
            "{$blog->uri}/(:any)" => 'Blog::post/$1',
        ];

        file_put_contents(self::PATH . 'Blog.php', "<?php return " . var_export($uris, true) . ';' . PHP_EOL);

        return $this;
    }

    public function imoveisSync()
    {
        $imoveis = [];

        /** @var Imovel $imovel */
        foreach ((new Imoveis())->findAll() as $imovel) {
            $key = $imovel->id;
            $value = $imovel->url;
            $imoveis[$key] = $value;
        }

        file_put_contents(self::PATH . 'Imoveis.php', "<?php return " . var_export($imoveis, true) . ';' . PHP_EOL);

        return $this;
    }

    /* Pages *///region Pages
    public function pagesSync()
    {
        $pages = [];

        /** @var SysPage $page */
        foreach ((new SysPages())->findAll() as $page) {
            $key = $page->uri;
            $value = $page->route_filter ? ['route' => $page->route, 'filter' => $page->route_filter] : $page->route;
            $pages[$key] = $value;
            $this->pageUris($page, $pages);
        }

        file_put_contents(self::PATH . 'Pages.php', "<?php return " . var_export($pages, true) . ';' . PHP_EOL);

        return $this;
    }

    private function pageUris($page, &$pages)
    {
        /** @var SysPageUri $item */
        foreach ($page->uris as $item) {
//			$uri = explode('/', $page->uri);
//			$uri[0] = $item->uri;
//			$uri = implode('/', $uri);
            $pages[$item->uri] = $page->route_filter ? ['route' => $page->route, 'filter' => $page->route_filter] : $page->route;
        }
    }

    //endregion

    public function syncAll()
    {
        return $this
            ->categoriesSync()
            ->citiesSync()
            ->imoveisSync()
            ->pagesSync()
            ->blogSync();
    }

    public function generateSiteMap()
    {
        convert_accented_characters();
        url_title();
    }

}