<?php

namespace App\Http\Controllers;

use App\Library\Notion\Util;
use App\Models\Post;
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
        return view('blog.index', ['blogList' => Post::index($blogDatabaseName)]);

    }

    function show($id)
    {
        $post = Post::show($id);
        $parsedown = new \Parsedown();
        return view('blog.show', ['post' => $post, 'parsedown' => $parsedown]);
    }
}
