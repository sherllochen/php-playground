<?php

namespace App\Http\Controllers;

use http\Message\Body;
use PhpParser\Node\Expr\Array_;
use WpOrg\Requests\Requests;

class NotionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     * @throws \Exception
     */
    public function show(): \Illuminate\View\View
    {
        $client = new \SherlloChen\NotionSdkPhp\Client();
        ddd($client->search('php'));
        return view('notion');
    }
}
