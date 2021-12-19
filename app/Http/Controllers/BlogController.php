<?php

namespace App\Http\Controllers;

use App\Library\Notion\Utils;
use App\Models\Post;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    // list of all blog from notion
    /**
     * @throws \Exception
     */
    function index(Request $request)
    {
        $blogDatabaseName = env('BLOG_DATABASE_NAME');
        $categories = \Cache::remember('categories', env('CACHE_TIME'), function () use ($blogDatabaseName) {
            return Utils::getCategoryList($blogDatabaseName);
        });
        $query = $request->query();
        $category = array_key_exists('category', $query) ? $query['category'] : '';
        $blogs = Post::index($category);
        return view('blog.index', ['blogList' => $blogs,
            'categories' => $categories]);
    }

    function show($id)
    {
        $post = Post::show($id);
        $parsedown = new \Parsedown();
        return view('blog.show', ['post' => $post, 'parsedown' => $parsedown]);
    }
}
