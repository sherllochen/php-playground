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

    function arrayNestedKeyExists(array $keyPath, array $array): bool
    {
        if (empty($keyPath)) {
            return false;
        }
        foreach ($keyPath as $key) {
            if (isset($array[$key]) || array_key_exists($key, $array)) {
                $array = $array[$key];
                continue;
            }

            return false;
        }

        return true;
    }
}
