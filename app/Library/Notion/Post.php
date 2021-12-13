<?php

namespace App\Library\Notion;

use SherlloChen\NotionSdkPhp\{Client, Utils};

class Post
{
    public $title;
    public $content;
    public $publishedDate;
    /**
     * @var string
     */
    public $pageId;

    public function __construct(string $pageId, string $title, string $published_date, array $content = [])
    {
        $this->pageId = $pageId;
        $this->title = $title;
        $this->publishedDate = $published_date;
        $this->content = $content;
    }

    static public function index($data): array
    {
        $postList = [];
        if (array_key_exists('results', $data)) {
            $data = $data['results'];
        }
        foreach ($data as $dataItem) {
            $pageId = $dataItem['id'];
            $publishedDate = $dataItem['created_time'];
            $title = \SherlloChen\NotionSdkPhp\Utils::parseTitleOfDataItem($dataItem);
            $postList[] = new Post($pageId, $title, $publishedDate);
        }
        return $postList;
    }

    static public function show($pageId): Post
    {
        $client = new \SherlloChen\NotionSdkPhp\Client();
        $page = $client->retrievePage($pageId);
        $blockListData = $client->retrieveBlockChildren($pageId);
        $content = [];
        foreach ($blockListData['results'] as $block) {
            $content[] = Post::parseContentFromBlock($block);
        }
        return new Post($page['id'], $page['properties']['Name']['title'][0]['plain_text'], $page['created_time'], $content);
    }

    static public function extractFromDataItem(array $dataItem): Post
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
        return new Post($pageId, $title, $publishedDate, $content);
    }

    static public function parseContentFromBlock($block): string
    {
        $blockType = $block['type'];
        $textSection = $block[$blockType]['text'];
        $text = '';
        if (count($textSection) > 0) {
            $text = $block[$blockType]['text'][0]['plain_text'];
        }
        return "${blockType} ${text}";
    }
}
