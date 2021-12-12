<?php

namespace App\Http\Controllers;

use App\Library\NotionUtil;
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
            return NotionUtil::getBlogList($blogDatabaseName);
        });
        $pageIdList = \Cache::rememberForever('page_id_list', function () use ($blogData) {
            return NotionUtil::getPageIdList($blogData);
        });
        $pageItems = \Cache::rememberForever('page_items', function () use ($pageIdList) {
            $tempItems = [];
            foreach ($pageIdList as $pageId) {
                $tempItems[] = NotionUtil::getPageContent($pageId);
            }
            return $tempItems;
        });

        ddd($pageItems);
        return view('blog.index', ['blogData' => $blogData]);

    }
}
