<?php

namespace App\Http\Controllers\Miaomiao;

use App\Http\Controllers\Controller;
use App\Services\VBase2\Api;
use Illuminate\Http\Request;
use App\Http\Requests;

class VBase2Controller extends Controller
{
    public function index()
    {
        return view('miaomiao.vbase2', [
            'title' => 'VBase2',
            'active' => 'vbase2',
        ]);
    }

    public function submit(Request $request, Api $api)
    {
        $activeUpload = $request->all()['activeUpload'];
        $content = array_reduce($request->all()[$activeUpload], function ($carry, $file) {
            $handle = fopen($file->path(), 'r');
            $data = fread($handle, $file->getClientSize());
            fclose($handle);
            return $carry . $data;
        }, '');

        $response = $api->dnaplot($content);

        $name = 'dna-plot-' . date(DATE_ISO8601);
  
        header("Content-Disposition: attachment; filename=\"{$name}.html\"");
        header('Content-Type: text/plain');
        header('Content-Length: ' . strlen($response));
        header('Connection: close');


        echo $response;
    }
}
