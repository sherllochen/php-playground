<?php

namespace App\Library\Notion;

use SherlloChen\NotionSdkPhp\Client;

class Utils
{
    /**
     * Mapping from Notion data to Blog data
     * Notion database of Blog => All Blog data
     * Data item of Notion database => Blog post
     * Blocks of page => Blog content
     */

    /**
     * @param array $queryArguments
     * @return array
     * @throws \Exception
     */
    static public function getBlogList(array $queryArguments = []): array
    {
        $client = new \SherlloChen\NotionSdkPhp\Client();
        $seconds = 60 * 60;
        $blogDatabaseName = env('BLOG_DATABASE_NAME');
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

    /**
     * Get category list with database name.
     * @param string $blogDatabaseName
     * @return array
     * ['TECH','LIFE','FUN']
     * @throws \Exception
     */
    static public function getCategoryList(string $blogDatabaseName): array
    {
        $client = new \SherlloChen\NotionSdkPhp\Client();
        $databaseId = $client->searchDatabaseByName($blogDatabaseName)['id'];
        $databaseDt = $client->retrieveDatabase($databaseId);
        $CategoryOptions = \SherlloChen\NotionSdkPhp\Utils::parseSelectPropertyOptions($databaseDt, 'Category');
        $result = [];
        foreach ($CategoryOptions as $option) {
            $result[] = $option['name'];
        }
        return $result;
    }
}
