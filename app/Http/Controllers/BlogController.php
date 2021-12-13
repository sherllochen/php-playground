<?php

namespace App\Http\Controllers;

use App\Library\Notion\Util;
use App\Library\Notion\Post;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    // list of all blog from notion
    /**
     * @throws \Exception
     */
    function index()
    {
        $blogDatabaseName = env('BLOG_DATABASE_NAME');

        $blogData = \Cache::rememberForever('blog_data', function () use ($blogDatabaseName) {
            return Util::getBlogList($blogDatabaseName);
        });
        $pageIdList = \Cache::rememberForever('page_id_list', function () use ($blogData) {
            return Util::getPageIdList($blogData);
        });
        $pageItems = \Cache::rememberForever('page_items', function () use ($pageIdList) {
            $tempItems = [];
            foreach ($pageIdList as $pageId) {
                $tempItems[] = Util::getPageContent($pageId);
            }
            return $tempItems;
        });

        return view('blog.index', ['blogData' => $blogData, 'blogList' => Post::index($blogData)]);

    }
}
