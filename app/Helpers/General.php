<?php

namespace App\Helpers;

use \App\Models\Post;

class General
{
    static function getPostCoverImage(Post $post): string
    {
//        random image generator url: https://picsum.photos/seed/{{seed}}/400/300
        $url = "https://picsum.photos/seed/{$post->id}/300/200";
        return $post->cover_image ?? $url;
    }
}
