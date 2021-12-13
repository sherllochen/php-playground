<?php

namespace App\Library\Notion;

use SherlloChen\NotionSdkPhp\Client;

class Util
{
    /**
     * Mapping from Notion data to Blog data
     * Notion database of Blog => All Blog data
     * Data item of Notion database => Blog post
     * Blocks of page => Blog content
     */

    /**
     * @param string $blogDatabaseName
     * @param array $queryArguments
     * @return array
     * @throws \Exception
     */
    static public function getBlogList(string $blogDatabaseName, array $queryArguments = []): array
    {
        $client = new \SherlloChen\NotionSdkPhp\Client();
        $seconds = 60 * 60;

        $databaseId = \Cache::remember('blog_database_id', $seconds,
            function () use ($blogDatabaseName, $client) {
                $database = $client->searchDatabaseByName($blogDatabaseName);
                return $database['id'];
            });
        return $client->queryADatabase($databaseId, $queryArguments);
    }

    static public function getPageIdList(array $dataResp): array
    {
        $pageIdList = [];
        foreach ($dataResp['results'] as $pageItem) {
            $pageIdList[] = $pageItem['id'];
        }
        return $pageIdList;
    }

    static public function getPageContent(string $pageId): array
    {
        $client = new \SherlloChen\NotionSdkPhp\Client();
        return $client->retrieveBlockChildren($pageId);
    }
}
