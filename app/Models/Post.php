<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Str;
use JetBrains\PhpStorm\ArrayShape;
use Sherllo\NotionSdkPhp\Utils;

class Post extends Model
{
    use HasFactory;

    protected $guarded = [];

    static public function index(string $category, array $args = [], bool $realtimeData = false)
    {
        $posts = [];
        if ($realtimeData) {
            $posts = self::indexFromNotion($category, $args);
        } else {
            $pageSize = $args['page_size'] ?? 10;
            $page = $args['page'] ?? 1;
            $posts = Post::where('category', $category)->paginate($pageSize, ['*'], 'posts', $page);
        }
        return $posts;
    }

    static public function indexFromNotion($category, $args, $withPageDetail = false): collection
    {
        $postIdList = [];
        $data = Util::getBlogList($category);
        if (array_key_exists('results', $data)) {
            $data = $data['results'];
        }
        foreach ($data as $dataItem) {
            $pageId = $dataItem['id'];
            if ($withPageDetail) {
                $posts[] = self::showFromNotion($pageId)->id;
            } else {
                $publishedDate = $dataItem['created_time'];
                $title = \SherlloChen\NotionSdkPhp\Utils::parseTitleOfDataItem($dataItem);
                $pageArgs = ['pageId' => $pageId, 'title' => $title, 'publishedDate' => date_create($publishedDate)];

                $post = Post::where('pageId', $pageId)->first();
                if ($post) {
                    $post->update($args);
                } else {
                    $post = Post::create($args);
                }
                $postIdList[] = $post->id;
            }
        }
        return Post::all()->where(['id' => $postIdList]);
    }

    static public function show(string $pageId, bool $realTimeData = false): Post
    {
        if ($realTimeData) {
            return self::showFromNotion($pageId);
        } else {
            return self::where('pageId', $pageId)->firstOrFail();
        }
    }

    static public function showFromNotion(string $pageId): Post
    {
        $client = new \SherlloChen\NotionSdkPhp\Client();
        $page = $client->retrievePage($pageId);
        $blockListData = $client->retrieveBlockChildren($pageId);
        $contentArray = self::blocksToMarkdownList($blockListData['results']);
        $content = self::mergeStringArray($contentArray);
        $htmlContent = self::markdownListToHtml($contentArray);
        $args = ['pageId' => $page['id'],
            'title' => $page['properties']['Name']['title'][0]['plain_text'],
            'publishedDate' => date_create($page['created_time']),
            'content' => $content,
            'html_content' => $htmlContent,
            'abstract' => Str::of($content)->substr(0, 30)];
        $post = Post::where('pageId', $page['id'])->first();
        if ($post) {
            $post->update($args);
        } else {
            $post = Post::create($args);
        }
        return $post;
    }

//    create post from database item
    static public function extractFromDatabaseItem(array $dataItem): Post
    {
        $pageId = $dataItem['id'];
        $publishedDate = $dataItem['created_time'];
        $title = \SherlloChen\NotionSdkPhp\Utils::parseTitleOfDataItem($dataItem);
        $client = new \SherlloChen\NotionSdkPhp\Client();
        $blockListData = $client->retrieveBlockChildren($pageId);

        $blockList = $blockListData['results'];
        $content = [];
        foreach ($blockList as $block) {
            $content[] = Post::parseContentFromBlock($block);
        }
        return new Post(['pageId' => $pageId, 'title' => $title, 'publishedDate' => date_create($publishedDate), 'content' => $content,
            'abstract' => Str::of($content)->substr(0, 30)]);
    }

    #[ArrayShape(['type' => "mixed", 'text' => "mixed"])] static public function parseContentFromBlock($block): array
    {
        $blockType = $block['type'];
        $textSection = $block[$blockType]['text'];
        $text = '';
        if (count($textSection) > 0) {
            $text = $block[$blockType]['text'][0]['plain_text'];
        }
        return ['type' => $blockType, 'text' => $text];
    }

//    convert notion block to
    static public function blocksToMarkdownList(array $blockList): array
    {
        $mapping = ['heading_1' => '# ',
            'heading_2' => '## ',
            'heading_3' => '### ',
            'heading_4' => '#### ',
            'heading_5' => '##### ',
            'paragraph' => '',
            'bulleted_list_item' => '- '
        ];
        $result = [];
        foreach ($blockList as $blockItem) {
            $content = self::parseContentFromBlock($blockItem);
            $result[] = $mapping[$content['type']] . $content['text'];
        }
        return $result;
    }

    static protected function mergeStringArray(array $stringArray): string
    {
        $result = '';
        foreach ($stringArray as $item) {
            $result = $result . $item . '\n';
        }
        return $result;
    }

//    convert markdown list to html string
    static public function markdownListToHtml(array $mdList): string
    {
        $result = '';
        $parsedown = new \Parsedown();
        foreach ($mdList as $item) {
            $result = $result . $parsedown->text($item);
        }
        return $result;
    }
}
