<?php

namespace App\Http\Controllers;

use App\Components\TagsParser;
use Illuminate\Http\Request;

class ParserController extends Controller
{
    public function parse(Request $request)
    {
        $parser = new TagsParser;
        $data = $parser->parse($request->url);

        return $data;
    }
}
