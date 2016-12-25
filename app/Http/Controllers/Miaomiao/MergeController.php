<?php

namespace App\Http\Controllers\Miaomiao;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests;

class MergeController extends Controller
{
    public function index()
    {
        return view('miaomiao.merge', [
            'title' => 'Merge text files',
            'active' => 'merge',
        ]);
    }

    public function merge(Request $request)
    {
        $content = array_reduce($request->all()['filesToUpload'], function ($carry, $file) {
            $handle = fopen($file->path(), 'r');
            $data = fread($handle, $file->getClientSize());
            fclose($handle);
            return $carry . $data;
        }, '');

        $name = 'merged-' . date(DATE_ISO8601);
  
        header("Content-Disposition: attachment; filename=\"{$name}.txt\"");
        header('Content-Type: text/plain');
        header('Content-Length: ' . strlen($content));
        header('Connection: close');


        echo $content;
    }
}
