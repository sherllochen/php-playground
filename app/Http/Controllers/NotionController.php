<?php

namespace App\Http\Controllers;

use WpOrg\Requests\Requests;

class NotionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function show(): \Illuminate\View\View
    {
        $databaseId = '166373bd1bc34f1f856032fd5f128377';
        $bear_token='Bearer '. env('API_TOKEN');
        $url = env('NOTION_BASE_URL')."databases/${databaseId}";
        $headers = array('Content-Type' => 'application/json','Authorization'=>$bear_token,'Notion-Version'=>env('NOTION_VERSION'));
        $data = array('some' => 'data');
        $response = Requests::get($url,$headers);
        ddd($response);
        return view('notion');
    }
}
